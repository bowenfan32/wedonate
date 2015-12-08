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

				{!! Form::open(array('url' => route('getCausesCreate'), 'class' => 'form')) !!}
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" placeholder="name">
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" name="description"></textarea>
					</div>
					<div class="checkbox">
				    <label>
				      <input type="checkbox" name="DGR" value="1"> DGR
				    </label>
				  </div>
					<div class="checkbox">
				    <label>
				      <input type="checkbox" name="active" value="1"> Active
				    </label>
				  </div>
					<button type="submit" class="btn btn-primary">Create</button>
				{!! Form::close() !!}

			</div>
		</div>
	</div>
</section>

@stop
