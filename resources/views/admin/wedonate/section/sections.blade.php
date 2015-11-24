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
					<h1 class="tw-700">Sections</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="mb-2">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				<a href="{{ route('getCreateSection') }}" class="btn btn-primary">Create Section</a>

			</div>
		</div>
	</div>
</section>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				<table class="table table-bordered">
				  <tr>
						<th>Title</th>
						<th>Tools</th>
					</tr>
					@foreach($sections as $section)
						<tr>
							<td>{{ $section->title }}</td>
							<td><a href="{{ route('getCauseoftheMonthSection') }}">modify</a></td>
						</tr>
					@endforeach
				</table>

			</div>
		</div>
	</div>
</section>

@stop
