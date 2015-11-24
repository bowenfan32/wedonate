@extends('layouts.default')

@section('content')

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h1 class="tw-700 mb-1">Donate</h1>
				{!! Form::open(array('url' => '#', 'class' => 'form')) !!}
					<div class="form-group">
						<label>Choose your cause</label>
						<select class="form-control">
							<option>weDonate</option>
						</select>
				  </div>
					<div class="form-group">
						<label>Amount</label>
						<input class="form-control" name="amount" value="7">
				  </div>
					<div class="form-group">
						<label>Split</label>
						<input type="range"  min="0" max="100" />
						<input type="range"  min="0" max="100" />
						<input type="range"  min="0" max="100" />
				  </div>
					<script
					  src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
					  data-key="pk_test_AqaoK4q4ydF2GBZNDyL5Arxa"
					  data-amount="100"
					  data-name="Demo Site"
					  data-description="weDonate Donation"
						data-email="">
					</script>

				  <!-- <input class="btn btn-primary btn-block" type="submit" value="Donate"> -->
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</section>

@stop

@section('js')
@stop
