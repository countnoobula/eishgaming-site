<?php

namespace App\Http\Controllers\Thirdparty;

use GuzzleHttp\Exception\ServerException;
use Socialite;
use App\Models\User;
use App\Models\GameUserActivity;
use GuzzleHttp\Client;

if (!defined('APPID_CSGO')) {
    define('APPID_CSGO', 730);
}
if (!defined('APPID_DOTA')) {
    define('APPID_DOTA', 570);
}

class SteamActivities
{
    public static function canSteamUpdateUser($steam)
    {
        $user = User::find(['steam_community_id' => $steam->id,])->first();

        if (is_null($user)) {
            return true;
        }

        // If this user is someone else don't allow update
        return ($user->id != auth()->user()->id);
    }

    public static function updateUserGames(User $user)
    {
        $client = new Client();

        $query = [
            'key' => config('services.steam.client_secret'),
            'steamid' => $user->steam_community_id,
            'include_played_free_games' => true,
            'format' => 'json',
            'appids_filter' => [APPID_CSGO, APPID_DOTA],
        ];

        $getOwned = $client->get('http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/', compact('query'));
        $response = json_decode($getOwned->getBody(), true);

        foreach (data_get($response, 'response.games', []) as $game) {
            switch (data_get($game, 'appid')) {
                case APPID_CSGO:
                    $activity = $user->gameActivities()->firstOrNew(['game' => 'CSGO',]);
                    $activity->minutes_played = data_get($game, 'playtime_forever');
                    $activity->rounds_played = null;
                    static::updateActivityCSGO($activity, $client, $user);
                    break;
                case APPID_DOTA:
                    $activity = $user->gameActivities()->firstOrNew(['game' => 'DOTA',]);
                    $activity->minutes_played = data_get($game, 'playtime_forever');
                    $activity->rounds_played = null;
                    static::updateActivityDOTA($activity, $client, $user);
                    break;
            }
        }
    }

    public static function updateActivityCSGO(GameUserActivity $activity, Client $client, User $user)
    {
        $query = [
            'appid' => APPID_CSGO,
            'key' => config('services.steam.client_secret'),
            'steamid' => $user->steam_community_id,
        ];

        try {
            $getStats = $client->get('http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/', compact('query'));
            $response = json_decode($getStats->getBody(), true);
        } catch (ServerException $ex) {
            $response = [];
        }

        $stats = collect(data_get($response, 'playerstats.stats', []))->keyBy('name');

        $secs = data_get($stats->get('total_time_played', []), 'value', 0);
        if ($secs > 0) {
            $activity->minutes_played = round($secs / 60);
        }

        $activity->rounds_played = data_get($stats->get('total_matches_played', []), 'value');

        $activity->save();
    }

    public static function updateActivityDOTA(GameUserActivity $activity, Client $client, User $user)
    {
        $query = [
            'account_id' => $user->steam_community_id,
            'key' => config('services.steam.client_secret'),
            'matches_requested' => 0,
        ];

        try {
            $getStats = $client->get("http://api.steampowered.com/IDOTA2Match_" . APPID_DOTA . "/GetMatchHistory/v1", compact('query'));
            $response = json_decode($getStats->getBody(), true);
        } catch (ServerException $ex) {
            $response = [];
        }

        if (data_get($response, 'result.status') !== 1) {
            return;
        }

        $activity->rounds_played = data_get($response, 'result.total_results', null);

        $activity->save();
    }
}
