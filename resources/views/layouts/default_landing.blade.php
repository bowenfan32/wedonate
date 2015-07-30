@extends('layouts.master')

@section('css_master')

@yield('css')

@stop

@section('content_master')

@include('interface.nav.top')

<header class="site-header">
	@include('interface.landing')
	<div class="landing-navbar">
		@include('interface.header')
	</div>
</header>

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
