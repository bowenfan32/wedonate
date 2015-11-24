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
					<h1 class="tw-700">Create a user</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="mb-3">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">


				<form class="form donate-form" action="{{ route('getUserCreate') }}" method="POST" data-parsley-validate>
					{!! Form::token() !!}
					<div class="form-group">
						<label>Firstname</label>
						<input type="text" name="firstname" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Lastname</label>
						<input type="text" name="lastname" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Confrim Password</label>
						<input type="password" name="confirm_password" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Referrer Code</label>
						<input type="text" name="referrer_code" class="form-control">
					</div>
					<div class="form-group">
						<label>Role</label>
						<select name="role" class="form-control">
							@foreach($roles as $role)
								<option value="{{ $role->id }}">{{ $role->display_name }}</option>
							@endforeach
						</select>
					</div>
					<div class="checkbox">
				    <label>
				      <input type="checkbox" name="active" value="1" checked="checked"> Active
				    </label>
				  </div>
					<button type="submit" class="btn btn-primary">Create</button>
				{!! Form::close() !!}

			</div>
		</div>
	</div>
</section>

@stop
