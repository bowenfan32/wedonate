@extends('layouts.default')

@section('content')

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header">
					<h1>Login</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				{!! Form::open(array('url' => 'connect', 'class' => 'form')) !!}
					<ul class="form-errors"> </ul>
					<div class="form-group">
						<label>Email address</label>
						<input type="email" name="email" class="form-control" placeholder="Email">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="Password">
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</section>

@stop
