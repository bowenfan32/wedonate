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
					<h1 class="tw-700">Causes</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="mb-2">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				<a href="{{ route('getCausesCreate') }}" class="btn btn-primary">Create Cause</a>

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
						<th>Name</th>
						<th>Number of Donations</th>
						<th>Total Donations</th>
						<th>DGR</th>
						<th>Tools</th>
					</tr>
					@foreach($causes as $cause)

						<tr>
							<td>{{ $cause->name }}</td>
							<td>{{ $cause->number_of_donations }}</td>
							<td>${{ $cause->total_donations }}</td>
							<td>@if ($cause->DGR == 1)Yes @else No @endif</td>
							<td><a href="{{ route('getCausesEdit', $cause->uuid)}}" class="c-black td-none">edit</a></td>
						</tr>

					@endforeach
				</table>

			</div>
		</div>
	</div>
</section>

@stop
