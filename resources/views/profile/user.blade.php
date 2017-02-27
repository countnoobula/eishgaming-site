@extends('layouts.banner', ['title' => $profile->getDisplayName(),])

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
    </div>
</div>
@stop
