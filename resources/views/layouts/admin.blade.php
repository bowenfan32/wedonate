@extends('layouts.master')

@section('css_master')

@yield('css')

@stop

@section('content_master')


<header class="site-admin-header">
	@include('interface.header_bak1')
</header>

<nav class="site-admin-header">
	@yield('menu_secondary')
</nav>

<div class="site-content" style="min-height: 77%;">
	@yield('content')
</div>

<footer class="site-footer">
	@include('interface.footer')
</footer>

@stop

@section('js_master')

@yield('js')

@stop
