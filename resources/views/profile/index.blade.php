@extends('layouts.default')

@section('title')
My Profile
@stop

@section('content')

<div class="pure-g">
    <div class="pure-u-1">
        <div class="egn-banner">
            <div class="egn-banner-content">
                <div class="egn-tag">[ {{ $profile->getTag() }} ]</div>
                <div class="egn-primary">{{ $profile->getDisplayName() }}</div>
            </div>
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
        <table>
            <tr><td><img src="{{ url('/images/csgo.png') }}" /></td><td><p>539 hrs<br>210 games</o></td></tr>
            <tr><td><img src="{{ url('/images/dota.png') }}" /></td><td><p>120 hrs<br>12 games</o></td></tr>
        </table>
    </div>
</div>
@stop