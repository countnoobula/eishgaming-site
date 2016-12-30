@extends('layouts.default')

@section('content')

<div class="pure-g">
    <div class="pure-u-1">
        <div class="egn-banner">
            <div class="egn-banner-content">
                <div class="egn-banner-inner">{{ $profile->getDisplayName() }}</div>
            </div>
        </div>
    </div>
</div>

@yield('inner_content')

@stop