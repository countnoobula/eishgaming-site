<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

final class ProfileController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $profile = auth()->user()->getProfile();
        return view('profile.index')
            ->with(compact('profile'));
    }
    
    public function user(User $user)
    {
        $profile = $user->getProfile();
        return view('profile.user')
            ->with(compact('profile'));
    }
    
    public function getEdit()
    {
        $profile = auth()->user()->getProfile();
        return view('profile.edit')
            ->with(compact('profile'));
    }
    
    public function postEdit(Request $request)
    {
        $this->validate($request, [
            'birthday' => 'required|date_format:Y-m-d|before:'. Carbon::now()->subYears(5)->format('Y-m-d'),
            'name' => 'required|string|max:120',
            'display_name' => 'string|max:120',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'password' => 'confirmed|string|min:6',
        ]);
        
        $user = auth()->user();
        
        $user->fill($request->only(['birthday', 'name', 'display_name', 'email', 'phone',]));
        
        $password = $request->get('password');
        if (strlen($password) >= 6) {
            $user->password = bcrypt($password);
        }
        
        $user->save();
        
        return redirect()->action('ProfileController@index');
        
    }
}
