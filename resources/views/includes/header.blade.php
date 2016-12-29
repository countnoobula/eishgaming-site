<div id="menu" class="pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed egn-menubar">
    <a href="{{ action('PageController@index') }}" class="pure-menu-heading"><img src="{{ url('/images/EGN.png') }}" class="pure-img"></a>
    <ul>
        <li><a href="{{ action('PageController@about') }}">About</a></li>
        <li><a href="{{ action('PageController@feed') }}">Group Feed</a></li>
        @if(auth()->check())
        <li><a href="{{ action('ProfileController@index') }}">My Profile</a></li>
        <li><a class="no-ajaxy" href="{{ action('Auth\AuthController@getLogout') }}">Logout</a></li>
        @else
        <li><a href="#" onclick="alert('Login with Facebook is currently disabled, this feature will reactivate soon')"><img id="facebook-login" class="pure-img" style="cursor:pointer" src="/images/login-with-facebook.png"></a></li>
        @endif
    </ul>
</div>
