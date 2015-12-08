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
					<h1 class="tw-700">Users</h1>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="mb-2">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				<a href="{{ route('getUserCreate') }}" class="btn btn-primary">Create User</a>

			</div>
		</div>
	</div>
</section>

<section>
	<div class="container full-size">
        @if (Session::has('flash_message'))
        <h3 style="color:#ff0000;">{{ Session::get('flash_message') }}</h3>
        @endif
		<div class="row">
			<div class="col-sm-12">

				<table class="table table-bordered">
				  <tr>
						<th>UUID</th>
						<th>Email</th>
						<th>Ranking</th>
						<th>Referrer</th>
						<th>Number of Referrals</th>
						<th>Donations Given</th>
						<th>Total Donations</th>
						<th>iDonate</th>
						<th>uDonate</th>
						<th>weDonate</th>
						<th>Amount Avail.</th>
						<th>Amount Avail. Forward</th>
						<th>Actions</th>
					</tr>
					@foreach($users as $user)

						<tr>
							<td>{{ $user->uuid }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->profile->ranking }}</td>
							<td></td>
							<td>{{ $user->profile->referrals }}</td>
							<td>{{ $user->profile->donations_count }}</td>
							<td>{{ $user->profile->total_donations }}</td>
							<td>{{ $user->profile->iDonate }}</td>
							<td>{{ $user->profile->uDonate }}</td>
							<td>{{ $user->profile->weDonate }}</td>
							<td>{{ $user->profile->amount }}</td>
							<td>{{ $user->profile->referrer_amount_forward }}</td>
							<td>
                                <a href="{{ route('getUserEdit', $user->uuid) }}"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('getUserRemove', $user->uuid) }}"><i class="fa fa-trash"></i></a>
                            </td>
						</tr>

					@endforeach
				</table>

			</div>
		</div>
	</div>
</section>

@stop
