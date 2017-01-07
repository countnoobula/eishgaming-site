<div id="menu" class="pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed egn-menubar">
    <a href="{{ action('PageController@index') }}" class="pure-menu-heading"><img src="{{ url('/images/EGN.png') }}" class="pure-img"></a>
    <ul>
        <li><a href="{{ action('PageController@about', [], false) }}">About</a></li>
        <li><a href="{{ action('PageController@servers', [], false) }}">Game Servers</a></li>
        @if(auth()->check())
        <li><a href="{{ action('ProfileController@index', [], false) }}">My Profile</a></li>
        <li><a class="no-ajaxy" href="{{ action('Auth\AuthController@getLogout') }}">Logout</a></li>
        @else
        <li><a class="no-ajaxy" href="{{ action('Thirdparty\Facebook@index') }}"><img id="facebook-login" class="pure-img" style="cursor:pointer" src="/images/login-with-facebook.png"></a></li>
        @endif
    </ul>
</div>
