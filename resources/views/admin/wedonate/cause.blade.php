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
					<h1 class="tw-700">Create a cause</h1>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				@if (isset($cause))

				{!! Form::open(array('url' => route('getCause', ['uuid' => $cause->uuid]), 'class' => 'form')) !!}
					<div class="form-group">
						<label>UUID</label>
						<input type="text" class="form-control" value="{{ $cause->uuid }}" disabled="disabled">
					</div>
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" placeholder="name" value="{{ $cause->name }}">
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" name="description" value="{{ $cause->description }}"></textarea>
					</div>
					<div class="checkbox">
				    <label>
							@if ($cause->DGR == 1)
				      	<input type="checkbox" name="DGR" value="1" checked> DGR
							@else
								<input type="checkbox" name="DGR"> DGR
							@endif
				    </label>
				  </div>
					<div class="checkbox">
				    <label>
							@if ($cause->active == 1)
				      <input type="checkbox" name="active" value="1" checked> Active
							@else
								<input type="checkbox" name="active"> Active
							@endif
				    </label>
				  </div>
					<button type="submit" class="btn btn-primary">Save</button>
				{!! Form::close() !!}

				@endif

			</div>
		</div>
	</div>
</section>

@stop
