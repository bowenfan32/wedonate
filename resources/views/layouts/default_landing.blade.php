@extends('layouts.master')

@section('css_master')

@yield('css')

@stop

@section('content_master')

@include('interface.nav.top')

<div id="menu">
    @include('interface.header_bak1')
</div>
<main id="panel">
    <div class="nav-bar" >
        <i class="fa fa-sign-in" data-toggle="modal" data-target="#global-connect-popup">
            <span>Connect</span>
        </i>

        <i class="fa fa-share-alt">
            <span>Share</span>
        </i>

        <i class="toggle-button fa fa-bars">
            <span>Menu</span>
        </i>
    </div>

    <header  class="site-header">
        @include('interface.landing')
    </header>

    <div class="site-content">
        @yield('content')
    </div>
</main>
<footer id="footer" class="site-footer">
    @include('interface.footer')
</footer>



<div class="overlay">
    <div class="content">
        <h1>Share</h1>
        <div class="icons">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
            <i class="fa fa-google-plus"></i>
        </div>
    </div>

    <i class="fa fa-times"></i>

</div>


@stop

@section('js_master')

@yield('js')
@stop
