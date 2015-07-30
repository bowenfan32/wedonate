<div class="global-popups">

	@include('interface.popups.connect')
	@include('interface.popups.donate')
	@include('interface.popups.share')
	@include('interface.popups.action')

</div>

<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<ul class="footer-nav">
					<li><a href="{{ URL::route('getHome') }}">Home</a></li>
					<li><a href="{{ URL::route('getFaq') }}">FAQ</a></li>
					<li><a href="{{ URL::route('getTerms') }}">Terms &amp; Conditions</a></li>
					<li><a href="{{ URL::route('getPrivacy') }}">Privacy</a></li>
				</ul>
			</div>
			<div class="col-sm-6">
				<p class="copy">
					weDonate Trust Fund &copy; 2015. All Rights Reserved.<br>
					ABN: 50 747 314 210
				</p>
			</div>
		</div>
	</div>
</footer>
