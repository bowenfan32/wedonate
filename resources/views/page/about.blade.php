@extends('layouts.default_landing')

@section('content')

<section class="bg" style="background-image: url('{{ asset('img/bg/bg_map.jpg') }}'); padding: 150px 50px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h1>Our Vision</h1>
				<p>We want donations to empower people like never before.</p>
			</div>
		</div>
	</div>
</section>

<section class="bg" style="background: #f6f6f6; padding: 150px 50px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-6"></div>
			<div class="col-sm-6 ta-right">
				<h1>Our Mission</h1>
				<p>To provide support to charities, not-for-profits, social enterprises and young professionals through an innovative online social network that enables people to give more – time and money.</p>
			</div>
		</div>
	</div>
</section>

<section class="bg" style="background-image: url('{{ asset('img/bg/bg_map.jpg') }}'); padding: 150px 50px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h1>Our Values</h1>
				<ul>
					<li>Innovation</li>
					<li>Collaboration</li>
					<li>Connectivity</li>
					<li>Energetic</li>
				</ul>
			</div>
		</div>
	</div>
</section>

@stop

@section('js')

@stop
