@extends('layouts.master')

@section('css_master')

@yield('css')

@stop

@section('content_master')

<header class="site-header">
	@include('interface.header')
</header>

<nav class="site-admin-header">
	@yield('menu_secondary')
</nav>

<div class="site-content">
	@yield('content')
</div>

<footer class="site-footer">
	@include('interface.footer')
</footer>

@stop

@section('js_master')

@yield('js')

@stop
