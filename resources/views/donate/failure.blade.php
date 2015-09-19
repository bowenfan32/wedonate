@extends('layouts.default_landing')

@section('content')

<section class="bg bg-white-pattern" style="padding: 120px 50px 150px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="page-header">
					<h1>Donation Unsuccessful!</h1>
				</div>
				<p>
					<strong>Cause:</strong> {{ $payment->cause->name }} <br>
					<strong>Amount:</strong> ${{ $payment->amount }}<br>
					<strong>UUID:</strong> ${{ $payment->uuid }}<br>
					<strong>Reason:</strong> ${{ $error->error_message }}
				</p>
			</div>
		</div>
	</div>
</section>

@stop

@section('js')

@stop
