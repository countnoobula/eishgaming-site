<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Clan;

final class ClanController extends Controller
{
    public function getView(Clan $clan)
    {
        $profile = $clan->getClan();
        return view('clan.view')
            ->with(compact('profile'));
    }
    
    public function getCreate()
    {
        return view('clan.create');
    }
    
    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:128',
            'tag' => 'required|string|max:20|unique:clans',
            'tag_position' => 'required|in:PREPEND,APPEND',
            'established' => 'required|date_format:Y-m-d|before:'. Carbon::now()->addDay()->format('Y-m-d'),
        ]);
        
        $clan = Clan::create($request->all());
        
        $clan->users()->save(auth()->user());
        
        auth()->user()->clans()->updateExistingPivot($clan->id, ['role' => 'manager']);
        
        return redirect()->action('ProfileController@index');
    }
}
