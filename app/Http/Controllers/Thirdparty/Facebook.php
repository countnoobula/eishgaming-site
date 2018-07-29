<?php

namespace App\Http\Controllers\Thirdparty;

use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;

final class Facebook extends Controller
{
    public function index()
    {
        return Socialite::with('facebook')->redirect();
    }
    
    public function getAuthenticate()
    {
        if (!$this->authenticate()) {
            return redirect('/')
                ->withErrors(['error' => 'Error logging in with your Facebook account. Please make sure your Facebook account is verified and try again']);
        }
        
        return redirect()
            ->action('ProfileController@index');
    }
    
    private function authenticate()
    {
        $user = Socialite::with('facebook')->user();
        
        if (!is_object($user)) {
            return false;
        }
        
        if (!data_get($user->user, 'verified', false)) {
            return false;
        }
        
        $user = $this->lookupUser($user);
        
        $user->save();
        auth()->login($user);
        
        return true;
    }
    
    private function lookupUser($fb)
    {
        //$user = User::withTrashed()->findOrNew(['facebook_id' => $fb->id,]);
        $user = User::firstOrNew(['facebook_id' => $fb->id,]);
        $user->is_profile = true;
        
        if (!$user->exists) {
            $user->birthday = null;
            $user->name = $fb->name;
            $user->email = $fb->email;
            $user->display_name = $fb->nickname;
        }
        
        return $user;
    }
}
