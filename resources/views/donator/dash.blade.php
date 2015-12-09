@extends('layouts.default_landing')

@section('content')

@include('donator.menu_secondary')

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header">
					<h1>Dashboard</h1>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="mb-3">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<a href="{{ route('getDonations') }}" class="btn btn-primary">View your Donations</a>
			</div>
		</div>
	</div>
</section>

@stop

@section('js')

@stop
