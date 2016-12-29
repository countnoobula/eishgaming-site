@extends('layouts.profile')

@section('title')
My Profile
@stop

@section('profile_content')

<div class="pure-g standard">
    <div class="pure-u-1-2 egn-standard-text-block">
        <h3>Profile</h3>
        <table class="egn-table">
            <tbody>
                <tr>
                    <td>Online Persona</td>
                    <td>{{ $profile->getDisplayName() }}</td>
                </tr>
                <tr>
                    <td>Full Name</td>
                    <td>{{ $profile->getName() }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $profile->getStatusLabel() }}</td>
                </tr>
                <tr>
                    <td>Age</td>
                    @if ($profile->getBirthday()->diffInYears() > 0)
                    <td>{{ $profile->getBirthday()->diffInYears() }} Years old</td>
                    @else
                    <td class="egn-highlight">(not set)</td>
                    @endif
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $profile->getEmail() }}</td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>{{ $profile->getPhoneNumber() }}</td>
                </tr>
            </tbody>
        </table>
        <p><a href="#">Edit Profile</a></p>
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
