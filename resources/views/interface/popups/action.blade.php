<div class="action">
	@if (session()->has('messages'))
		<i class="fa fa-exclamation"></i> {{ session('messages') }}
	@endif

	@if (isset($messages))
		<i class="fa fa-exclamation"></i> {{ $messages }}
	@endif
</div>
