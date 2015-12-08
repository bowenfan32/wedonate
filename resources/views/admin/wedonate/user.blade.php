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
					<h1 class="tw-700">User: {{ $profile->firstname }} {{$profile->lastname }}</h1>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container">
        @if (Session::has('flash_message'))
        <h3 style="color:#ff0000;">{{ Session::get('flash_message') }}</h3>
        @endif
		<div class="row">
			<div class="col-sm-12">

				@if (isset($user))

				{!! Form::open(array('url' => route('postUserEdit', ['uuid' => $user->uuid]), 'class' => 'form')) !!}
					<div class="form-group">
						<label>UUID</label>
						<input type="text" class="form-control" value="{{ $user->uuid }}" disabled="disabled">
					</div>
                    <div class="form-group">
                        <label>Firstname</label>
                        <input type="text" name="firstname" class="form-control" value="{{ $profile->firstname }}">
                    </div>
                    <div class="form-group">
                        <label>Lastname</label>
                        <input type="text" name="lastname" class="form-control" value="{{ $profile->lastname }}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                    </div>

					<button type="submit" class="btn btn-primary">Save</button>
				{!! Form::close() !!}

				@endif

			</div>
		</div>
	</div>
</section>

@stop
