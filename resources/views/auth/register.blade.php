@extends('layouts.default')

@section('content')

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="tw-700 mb-1">Register</h1>
			</div>
		</div>
	</div>
</div>

<section>
	<div class="container">
		<div class="row">

			<div class="col-sm-6">
				{!! Form::open(array('url' => 'signup', 'class' => 'form')) !!}
					<div class="form-group">
						<label>Firstname</label>
						<input type="text" name="firstname" class="form-control" placeholder="firstname">
					</div>
					<div class="form-group">
						<label>Lastname</label>
						<input type="text" name="lastname" class="form-control" placeholder="lastname">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" placeholder="email">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="password">
					</div>
					<div class="form-group">
						<label>Referrer Email</label>
						<input type="password" class="form-control" placeholder="">
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
