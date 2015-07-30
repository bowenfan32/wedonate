<div class="modal fade donate popup" id="global-donate-popup" tabindex="-1" role="dialog" aria-labelledby="global-donate-popup">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
				<div class="page-header mt-025">
					<h1 class="mt-0">Donate</h1>
				</div>
				<form class="form donate-form" action="{{ route('donate_stripe') }}" method="POST" id="donate-form" data-parsley-validate>
					{!! Form::token() !!}
					<input type="hidden" name="email" value="@if (Auth::check()){{ Auth::user()->email }}@endif">
					<input type="hidden" name="uuid" value="@if (Auth::check()){{ Auth::user()->uuid }}@endif">

					<div class="form-group">
						<label>Choose your cause</label>
						<select name="cause" class="form-control">
              @foreach($GLOBAL_CAUSES as $cause)
				       <option value="{{ $cause->uuid }}" data-name="{{ $cause->name }}">{{ $cause->name }}</option>
						  @endforeach
            </select>
				  </div>
					<div class="form-group">
						<label>Amount</label>
						<input class="form-control" name="amount" value="7" data-parsley-type="number" required>
				  </div>
					<div class="form-group">
						<label>Card Number</label>
						<input type="text" class="form-control" size="20" data-stripe="number" required>
				  </div>
					<div class="form-group">
						<label>CVC</label>
						<input type="text" class="form-control" size="4" data-stripe="cvc" required>
				  </div>
					<div class="form-group">
						<label>Expiration (MM/YYYY)</label>
						<input type="text" class="form-control" size="2" data-stripe="exp-month" required>
				  </div>
					<div class="form-group">
						<label>Year</label>
						<input type="text" class="form-control" size="4" data-stripe="exp-year" required>
				  </div>
					<!-- <div class="form-group">
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
					</script>-->

					<button id="donate" class="btn btn-secondary btn-block">Donate</button>

				</form>
      </div>
    </div>
  </div>

</div>
