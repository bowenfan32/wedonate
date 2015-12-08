@extends('layouts.admin')

@section('css')

<link href="{{ asset('lib/dropzone/basic.min.css') }}">
<link href="{{ asset('lib/dropzone/dropzone.min.css') }}">

@stop

@section('menu_secondary')

@include('admin.wedonate.menu_secondary')

@stop

@section('content')

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header">
					<h1 class="tw-700">Edit cause: {{ $cause->name }}</h1>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">

				{!! Form::open(array('url' => route('postCausesEdit', $cause->uuid), 'class' => 'form')) !!}
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" placeholder="name" value="{{ $cause->name }}">
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" name="description">{{ $cause->description }}</textarea>
					</div>
					<div class="checkbox">
				    <label>
							@if ($cause->DGR == 0)
				      	<input type="checkbox" name="DGR" value="1"> DGR
							@else
				      	<input type="checkbox" name="DGR" value="1" checked="checked"> DGR
							@endif
				    </label>
				  </div>
					<div class="checkbox">
				    <label>
							@if ($cause->active == 0)
				      	<input type="checkbox" name="active" value="1"> Active
							@else
				      	<input type="checkbox" name="active" value="1" checked="checked"> Active
							@endif
				    </label>
				  </div>

					<div class="form-group">
						<label>Image</label>
						<div style="border: 1px solid #eee">
							<img src="/uploads/ci/{{ $cause->image }}" style="width: 100%;">
						</div>
					</div>

					<button type="submit" class="btn btn-primary">Update</button>
					<a href="{{ route('getCauseRemove', $cause->uuid) }}" class="btn btn-sm btn-primary pull-right">delete</a>
				{!! Form::close() !!}

			</div>

			<div class="col-sm-6">
				<form id="dz" class="dropzone" action="{{ route('postCauseImage', $cause->uuid) }}" enctype="multipart/form-data" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group fallback">
						<input type="file" name="file" id="file" class="form-group" multiple>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

@stop

@section('js')
<script src="{{ asset('lib/dropzone/dropzone.js') }}"></script>
<script>

	$(document).ready(function() {
	});

</script>

@stop
