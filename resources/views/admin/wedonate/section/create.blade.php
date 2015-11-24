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
					<h1 class="tw-700">Create a section</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				{!! Form::open(array('url' => route('postCreateSection'), 'class' => 'form')) !!}
					<div class="form-group">
						<label>Title</label>
						<input type="text" name="title" class="form-control" placeholder="title">
					</div>
					<button type="submit" class="btn btn-primary">Create</button>
				{!! Form::close() !!}

			</div>
		</div>
	</div>
</section>

@stop
