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
        <div class="error-message">

        @if ( $errors->count() > 0 )
        <h3>The following errors have occurred:</h3>

        <ul>
            @foreach( $errors->all() as $message )
            <li>{{ $message }}</li>
            @endforeach
        </ul>
        @endif

        @if (Session::has('flash_message'))
            <h3>{{ Session::get('flash_message') }}</h3>
        @endif
        </div>
		<div class="row">
			<div class="col-sm-12">

				{!! Form::open(array('url' => route('getCausesCreate'), 'class' => 'form')) !!}
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name"  id="name" class="form-control" placeholder="name">
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" name="description" id="description"></textarea>
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
