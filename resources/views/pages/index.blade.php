@extends('layouts.default')

@section('title')
Eish Gaming Network
@stop

@section('content')
@include ("includes/alert")
<div class="wrapper">
    <div class="pure-g">
        <div class="pure-u-1">
            <h1>Welcome TO EGN</h1>
        </div>
        <div class="pure-u-1-2 egn-block egn-block__pad">
            <h3>New here?</h3>
            <p>	EGN is a place for game enthusiasts of all kinds to get together and share their gaming experience online!. 
                We have everything from tabletop games to steam profile integration and a most importantly, dedicated servers!
            </p>
        </div>
        <div class="pure-u-1-2 egn-block egn-block__pad">
            <h3>Want to join?</h3>
            <p>If you would like to join us, simply log in with your Facebook account and you will be added to the Storm cloud, which will allow you to also connect with other Storm systems. Registration is free and lets you gain access to our gaming network.</p>
        </div>
        <div class="pure-u-1">
            <h1>News</h1>
        </div>
        @foreach ($newsArticles as $article)
            @include('objects.article', $article);
        @endforeach
    </div>
</div>
@stop