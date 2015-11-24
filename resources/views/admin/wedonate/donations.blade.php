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
					<h1 class="tw-700">Donations</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				<table class="table table-bordered">
				  <tr>
						<th>ID</th>
						<th>User</th>
						<th>Amount</th>
						<th>Cause</th>
						<th>DGR</th>
						<th>Date</th>
					</tr>
					@foreach($donations as $donation)

						<tr>
							<td>{{ $donation->uuid }}</td>
							<td>{{ $donation->user_id }}</td>
							<td>{{ $donation->amount }}</td>
							<td>{{ $donation->cause_id }}</td>
							<td>@if ($donation->DGR == 1)Yes @else No @endif</td>
							<td>{{ $donation->created_at }}</td>
						</tr>

					@endforeach
				</table>

			</div>
		</div>
	</div>
</section>

@stop
