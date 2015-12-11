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
					<h1 class="tw-700">Breakdown</h1>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="mb-2">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

                <table class="table table-bordered">
                    <tr>
                        <th>Cause</th>
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
                        <td><a href="" class="c-black td-none"><i class="fa fa-pencil"></i></a></td>
                    </tr>

                    @endforeach
                </table>

			</div>
		</div>
	</div>
</section>

@stop
