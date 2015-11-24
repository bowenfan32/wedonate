@extends('layouts.default')

@section('css')

@stop

@section('content')

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="tw-700 mb-1">Frogot Password</h1>
			</div>
		</div>
	</div>
</div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				{!! Form::open(array('url' => 'connect/forgot-password', 'class' => 'form')) !!}
					<ul class="form-errors"></ul>
					<input type="hidden" name="uuid">
					<div class="form-group">
						<label>Password</label>
						<input type="email" name="email" class="form-control" placeholder="Email">
					</div>
					<div class="form-group">
						<label>Repeat Password</label>
						<input type="password" name="password" class="form-control" placeholder="Password">
					</div>
					<div class="form-group">
						<label>Check</label>
						<div class="g-recaptcha" data-sitekey="6LeM9wgTAAAAABKpSC1jMgiw0bArsCa7z_R2_5Ut"></div>
						<script src='https://www.google.com/recaptcha/api.js'></script>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</section>

@stop

@section('js')

@stop
