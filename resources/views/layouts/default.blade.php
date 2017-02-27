@if (Request::ajax())
    <section id="content" data-uri="{{{ Request::path() == "/" ? "/" : "/" . Request::path() }}}" style="display: none;">
        <div class="document-title" style="display:none;">EGN - {{ $title }}</div>
        
        @yield('content')
    </section>
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

        <section id="content" class="content" data-uri="{{{ Request::path() == "/" ? "/" : "/" . Request::path() }}}">
            @yield('content')
        </section>

        @include('includes.foot')
    </body>
</html>
@endif