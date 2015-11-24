@extends('layouts.admin')

@section('menu_secondary')

@include('admin.wedonate.menu_secondary')

@stop

@section('content')

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header">
					<h1 class="tw-700">Funds</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="mb-3">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">

				<h3 class="tt-caps">{{ $funds_single->type }}</h3>
				<h1>$ {{ $funds_single->amount }}</h1>

			</div>
			<div class="col-sm-6">

				<h3 class="tt-caps">{{ $funds_subs->type }}</h3>
				<h1>$ {{ $funds_subs->amount }}</h1>

			</div>
		</div>
	</div>
</section>

@stop
