<?php

namespace App\Http\Controllers\Thirdparty;

use App\Http\Controllers\Controller;
use Socialite;
final class Steam extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->key = config('services.steam.client_secret');
    }
    
    public function index()
    {
        return Socialite::with('steam')->redirect();
    }
    
    public function getAuthenticate()
    {
        $steam = Socialite::with('steam')->user();
        
        if (!is_object($steam)) {
            return redirect('/')
                ->withErrors(['error' => 'Error authenticating with Steam, please try again later.']);
        }
        
        if (!SteamActivities::canSteamUpdateUser($steam)) {
            return redirect('/')
                ->withErrors(['error' => 'Your Steam account is associated with an existing EGN profile.']);
        }
        
        $user = auth()->user();
        $user->is_gaming = true;
        $user->steam_primary_clan = data_get($steam->user, 'primaryclanid');
        $user->steam_community_id = $steam->id;
        $user->steam_id = $this->calculateSteamID($steam->id);
        $user->save();
        
        SteamActivities::updateUserGames($user);
        
        return redirect()
            ->action('ProfileController@index');
    }

    private function calculateSteamID($communityid)
    {
        $authserver = bcsub($communityid, '76561197960265728') & 1;
        $authid = (bcsub($communityid, '76561197960265728') - $authserver) / 2;
        return "STEAM_0:{$authserver}:{$authid}";
    }
}
