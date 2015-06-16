<div class="pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed egn-menubar">
    <a href="{{ route('index') }}" class="pure-menu-heading main-click"><img src="/images/EGN.png" class="pure-img"></a>
    <ul>
        <li><a href="{{ route('about') }}" class="main-click">About</a></li>
        <li><a href="{{ route('feed/landing') }}" class="main-click">Group Feed</a></li>
        <li><a href="#" onclick="alert('Login with Facebook is currently disabled, this feature will reactivate soon')"><img id="facebook-login" class="pure-img" style="cursor:pointer" src="/images/login-with-facebook.png"></a></li>
    </ul>
</div>
