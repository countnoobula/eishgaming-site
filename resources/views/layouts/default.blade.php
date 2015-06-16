{{-- Only yield content if ajax is requested --}}
@if (Request::ajax())
    @yield('content')
@else
<!doctype html>
<html class="l-html" lang="en">
    <head>
        @include('includes.head')
    </head>

    <body>
        <!--[if lt IE 9]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/?locale=en">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        @include('includes.header')

        <div id="innterContent">
            @yield('content')
        </div>

        @include('includes.foot')
    </body>
</html>
@endif