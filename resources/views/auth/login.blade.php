@extends('layouts.default')

@section('title')
Login
@stop

@section('content')
<div class="wrapper">
    <div class="pure-g">
        <div class="pure-u-md-1-2 pure-u-sm-1 egn-block egn-block__pad">
            <h1>Login</h1>
            <p>
                Login using your e-mail and password (if you have them) otherwise use login with Facebook. New EGN account will be created if you do not have one.
            </p>
            <form class="egn-form pure-form-aligned" method="POST" action="{{ action('Auth\AuthController@postLogin') }}">
                @include ('messages')
                <fieldset>
                    <div class="pure-control-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" name="email" required="required" value="{{ old('email') }}">
                    </div>
                    <div class="pure-control-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required="required">
                    </div>
                    <div class="pure-control-group">
                        <label for="remember" class="pure-checkbox">
                            <input id="remember" type="checkbox" name="remember" checked="checked"> Remember Me
                        </label>

                        <button type="submit" class="pure-button pure-button-primary">Login</button>
                    </div>
                </fieldset>
                {!! csrf_field() !!}
            </form>
        </div>
    </div>
</div>
@stop