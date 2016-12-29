<?php

namespace App\Http\Controllers;

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
}
