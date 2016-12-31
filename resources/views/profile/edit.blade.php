
@extends('layouts.banner')

@section('title')
Edit Profile
@stop

@section('inner_content')
<div class="wrapper">
    <div class="pure-g">
        <div class="pure-u-md-1-2 pure-u-sm-1 egn-block egn-block__pad">
            <h1>Edit Profile</h1>
            <form class="egn-form pure-form-aligned" method="POST" action="{{ action('ProfileController@postEdit') }}">
                @include ('messages')
                <fieldset>
                    <div class="pure-control-group">
                        <label for="birthday">Birthday (YYYY-MM-DD)</label>
                        <input id="birthday" type="date" name="birthday" required="required" value="{{ old('birthday', $profile->getBirthday()->format('Y-m-d')) }}">
                    </div>
                    <div class="pure-control-group">
                        <label for="name">Full Name</label>
                        <input id="name" type="text" name="name" required="required" value="{{ old('name', $profile->getName()) }}">
                    </div>
                    <div class="pure-control-group">
                        <label for="display_name">Online Persona</label>
                        <input id="display_name" type="text" name="display_name" value="{{ old('display_name', $profile->getDisplayName()) }}">
                    </div>
                    <div class="pure-control-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" required="required" value="{{ old('email', $profile->getEmail()) }}">
                    </div>
                    <div class="pure-control-group">
                        <label for="phone">Phone Number</label>
                        <input id="phone" type="text" name="phone" required="required" value="{{ old('phone', $profile->getPhoneNumber()) }}">
                    </div>
                    <div class="pure-control-group">
                        <label for="password">Change Password</label>
                        <input id="password" type="password" name="password" value="">
                    </div>
                    <div class="pure-control-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" value="">
                    </div>
                    <div class="pure-control-group" style="margin: 2em;">
                        <p>
                        <a class="pure-button" href="{{ action('ProfileController@index') }}">Back to profile</a>
                        <button type="submit" class="pure-button pure-button-primary">Save Profile</button>
                        </p>
                    </div>
                </fieldset>
                {!! csrf_field() !!}
            </form>
        </div>
    </div>
</div>
@stop
