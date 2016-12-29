@extends('layouts.default')

@section('title')
My Profile
@stop

@section('content')

<div class="pure-g">
    <div class="pure-u-1" style="position: relative;background: transparent url('{{ url('/images/wave.jpg') }}') no-repeat center center; background-size: cover; min-height: 22em;">
        <div style="position: absolute; left:0px; bottom: 0px; ; width: 100%;">

            <div style="overflow: hidden; width: 4.5em; text-align: right; margin-right: 0.3em; float: left;color:#fff; font-size: 2.4em; padding: 0.2em;background-color: rgba(0,0,0,0.65);">[ {{ $profile->getTag() }} ]</div>
            <div style="overflow: hidden; color:#fff; font-size: 2.4em; padding: 0.2em;background: -moz-linear-gradient(left, rgba(0,0,0,0.65) 0%, rgba(0,0,0,0) 100%);">{{ $profile->getDisplayName() }}</div>
        </div>
    </div>
</div>
<div class="pure-g standard">
    <div class="pure-u-1-2 egn-standard-text-block">
        <h3>Emblems</h3>
        <p>
        <button class="pure-button">Unverified User</button>
        </p>
    </div>
    <div class="pure-u-1-2 egn-standard-text-block">
        <h3>Games</h3>
        <table><tr><td><img src="{{ url('/images/csgo.png') }}" /></td><td><p>539 hrs<br>210 games</o></td>
        <table><tr><td><img src="{{ url('/images/dota.png') }}" /></td><td><p>120 hrs<br>12 games</o></td>
    </div>
</div>
@stop