@extends('layouts.banner')

@section('title')
My Profile
@stop

@section('inner_content')

<div class="wrapper">
    <div class="pure-g">
        @can ('access.gaming')
        <div class="pure-u-lg-1-2 pure-u-1-1 egn-block egn-block__pad">
            <h3>Clans</h3>
            
            <div class="egn-clans">
            @foreach ($profile->getClans() as $clan)
                @include ('objects.clan', [$clan])
            @endforeach
            </div>
    
            <p><a href="{{ action('ClanController@getCreate') }}">New Clan</a></p>
        </div>
        
        <div class="pure-u-lg-1-2 pure-u-1-1 egn-block egn-block__pad">
            <h3>Games</h3>
            
            <div class="egn-games">
            @foreach ($profile->getGames() as $game)
                @include ('objects.game', [$game])
            @endforeach
            </div>
        </div>
        
        @endcan
        
        @if (is_null(data_get(auth()->user(), 'steam_community_id')))
        <div class="pure-u-lg-1-2 pure-u-1-1 egn-block egn-block__pad">
            <h3>Connect Steam</h3>
            
            <div class="egn-thirdparty-signin">
                <a class="no-ajaxy" href="{{ action('Thirdparty\Steam@index') }}"><img src="{{ url('/images/sits_small.png') }}" alt="Sign in with steam" /></a>
            </div>
        </div>
        @endif
        
        @can ('access.profile')
        <div class="pure-u-lg-1-2 pure-u-1-1 egn-block egn-block__pad">
            <h3>Profile</h3>
            
            @include ('objects.profile', [$profile])
            <p><a href="{{ action('ProfileController@getEdit') }}">Edit Profile</a></p>
        </div>
        @endcan
    </div>
</div>
@stop
