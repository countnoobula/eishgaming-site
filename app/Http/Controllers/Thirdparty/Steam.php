<?php

namespace App\Http\Controllers\Thirdparty;

use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;
use App\Models\GameUserActivity;
use GuzzleHttp\Client;

final class Steam extends Controller
{
    const CSGO = 730;
    const DOTA = 570;
    protected $key;
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->key = config('services.steam.client_secret');
    }
    
    public function index()
    {
        $this->updateUserGames(auth()->user());
        return Socialite::with('steam')->redirect();
    }
    
    public function getAuthenticate()
    {
        $steam = Socialite::with('steam')->user();
        
        if (!is_object($steam)) {
            return redirect('/')
                ->withErrors(['error' => 'Error authenticating with Steam, please try again later.']);
        }
        
        if (!$this->canSteamUpdateUser($steam)) {
            return redirect('/')
                ->withErrors(['error' => 'Your Steam account is associated with an existing EGN profile.']);
        }
        
        $user = auth()->user();
        $user->is_gaming = true;
        $user->steam_primary_clan = data_get($steam->user, 'primaryclanid');
        $user->steam_community_id = $steam->id;
        $user->steam_id = $this->calculateSteamID($steam->id);
        $user->save();
        
        $this->updateUserGames($user);
        
        return redirect()
            ->action('ProfileController@index');
    }
    
    private function canSteamUpdateUser($steam): bool
    {
        $user = User::find(['steam_community_id' => $steam->id,])->first();
        
        if (is_null($user)) {
            return true;
        }
        
        // If this user is someone else don't allow update
        return ($user->id != auth()->user()->id);
    }
    
    private function calculateSteamID($communityid): string
    {
        $authserver = bcsub($communityid, '76561197960265728') & 1;
        $authid = (bcsub($communityid, '76561197960265728') - $authserver) / 2;
        return "STEAM_0:{$authserver}:{$authid}";
    }
    
    private function updateUserGames(User $user)
    {
        $client = new Client();
        
        $query = [
            'key' => $this->key,
            'steamid' => $user->steam_community_id,
            'include_played_free_games' => true,
            'format' => 'json',
            'appids_filter' => [self::CSGO, self::DOTA],
        ];
        
        $getOwned = $client->get('http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/', compact('query'));
        $response = json_decode($getOwned->getBody(), true);
        
        foreach (data_get($response, 'response.games', []) as $game) {
            switch (data_get($game, 'appid')) {
                case self::CSGO:
                    $activity = $user->gameActivities()->firstOrNew(['game' => 'CSGO',]);
                    $activity->minutes_played = data_get($game, 'playtime_forever');
                    $activity->rounds_played = null;
                    $this->updateActivityCSGO($activity, $client, $user);
                    break;
                case self::DOTA:
                    $activity = $user->gameActivities()->firstOrNew(['game' => 'DOTA',]);
                    $activity->minutes_played = data_get($game, 'playtime_forever');
                    $activity->rounds_played = null;
                    $this->updateActivityDOTA($activity, $client, $user);
                    break;
            }
        }
    }
    
    private function updateActivityCSGO(GameUserActivity $activity, Client $client, User $user)
    {
        $query = [
            'appid' => self::CSGO,
            'key' => $this->key,
            'steamid' => $user->steam_community_id,
        ];
        
        $getStats = $client->get('http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/', compact('query'));
        $response = json_decode($getStats->getBody(), true);
        
        $stats = collect(data_get($response, 'playerstats.stats', []))->keyBy('name');
        
        $secs = data_get($stats->get('total_time_played', []), 'value', 0);
        if ($secs > 0) {
            $activity->minutes_played = round($secs / 60);
        }
        
        $activity->rounds_played = data_get($stats->get('total_matches_won', []), 'value');
        
        $activity->save();
    }
    
    private function updateActivityDOTA(GameUserActivity $activity, Client $client, User $user)
    {
        $query = [
            'account_id' => $user->steam_community_id,
            'key' => $this->key,
            'matches_requested' => 0,
        ];
        
        $getStats = $client->get("http://api.steampowered.com/IDOTA2Match_".self::DOTA."/GetMatchHistory/v1", compact('query'));
        $response = json_decode($getStats->getBody(), true);
        
        if (data_get($response, 'result.status') !== 1) {
            return;
        }
        
        $activity->rounds_played = data_get($response, 'result.total_results', null);
        
        $activity->save();
    }
}
