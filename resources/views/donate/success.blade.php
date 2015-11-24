@extends('layouts.default_landing')

@section('content')

<section class="bg bg-white-pattern" style="padding: 120px 50px 150px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="page-header">
					<h1>Donation Success!</h1>
				</div>
				<p>
					<strong>Cause:</strong> {{ $payment->cause->name }} <br>
					<strong>Amount:</strong> ${{ $payment->amount }}
				</p>
			</div>
		</div>
	</div>
</section>

@stop

@section('js')

@stop
