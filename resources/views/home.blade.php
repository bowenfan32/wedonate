@extends('layouts.default_landing')

@section('content')

<section class="ta-center" style="padding: 100px 50px;">
	<div class="container">
		<div class="row mb-3">
			<div class="col-sm-12">
				<h1>
					They say that you get out of life what you put into it. Well you get a lot out of volunteering with the weDonate team.
				</h1>
				<h3>By volunteering with us you get the opportunity to:</h3>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-sm-4">
				<p>Develop professional skills in an area relevant to you development?</p>
			</div>
			<div class="col-sm-4">
				<p>Connect with other young and dedicated professionals</p>
			</div>
			<div class="col-sm-4">
				<p>Learn new things</p>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-sm-4">
				<p>Make a bigger positive difference for communities at home and abroad</p>
			</div>
			<div class="col-sm-4">
				<p>Be part of an innovative and energetic team</p>
			</div>
			<div class="col-sm-4">
				<p>Make heaps of new friends</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h3>And much more!</h3>
			</div>
		</div>
	</div>
</section>

<section class="ta-center" style="background: #333; padding: 150px 50px; color: #fff;">
	<div class="container">
		<div class="row mb-3">
			<div class="col-sm-12">
				<h1>Are you?</h1>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-sm-4">
				<p>Passionate about helping others</p>
			</div>
			<div class="col-sm-4">
				<p>Willing to dedicate approximately 10 hours a week for the next 6–12 months</p>
			</div>
			<div class="col-sm-4">
				<p>Looking for an upbeat, dynamic working environment</p>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-sm-4">
				<p>Wanting freedom and flexibility to control your own responsibilities</p>
			</div>
			<div class="col-sm-4">
				<p>Self-sufficient and able to meet deadlines</p>
			</div>
			<div class="col-sm-4">
				<p>Chasing the latest tech trends</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<p>A team-player with some creative flair</p>
			</div>
			<div class="col-sm-4">
				<p>Currently studying a tertiary degree or working full-time</p>
			</div>
			<div class="col-sm-4">
				<p>Looking to accelerate your personal and professional development</p>
			</div>
		</div>
	</div>
</section>

<section class="ta-center" style="padding: 150px 50px;">
	<div class="container">
		<div class="row mb-3">
			<div class="col-sm-12">
				<h1>We support our volunteers with a thorough induction process and clear guidelines.</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<p>
					We partner with other charities, not-for-profits and social enterprises who also need volunteer assistance.
				</p>
				<p>
					If you have specific skills you want to develop, we will try to find the right role to help you – either with us or one of our reputable partner organisations.
				</p>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container full-size">
		<div class="row">
			<div class="col-sm-12">
				<div class="map" id="map" style="width: 100%; height: 480px;"></div>
			</div>
		</div>
	</div>
</section>

@stop

@section('js')

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script>

	function initialize() {
		var mapOptions = {
			zoom: 15,
			maxZoom: 25,
			center: new google.maps.LatLng(-37.809336, 145.008337),
			mapTypeControl: false,
			scaleControl: false,
			scrollwheel: false,
			streetViewControl: false,
			draggable: true,
			overviewMapControl: false,
			disableDoubleClickZoom: false,
			mapTypeId: google.maps.MapTypeId.TERRAIN
		};

		var map = new google.maps.Map(document.getElementById('map'),
		mapOptions);

		// [START region_polyline]
		// Define a symbol using a predefined path (an arrow)
		// supplied by the Google Maps JavaScript API.
		var lineSymbol = {
			path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
		};

		// Create the polyline and add the symbol via the 'icons' property.

		var lineCoordinates = [
		new google.maps.LatLng(-37.809243, 145.007414),
		new google.maps.LatLng(-37.809336, 145.008337)
		];

		// var line = new google.maps.Polyline({
		// 	path: lineCoordinates,
		// 	icons: [{
		// 		icon: lineSymbol,
		// 		offset: '100%'
		// 	}],
		// 	map: map
		// });

		var myLatlng = new google.maps.LatLng(-37.809578, 145.008519);

		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title: 'Hello World!'
		});

	}

	google.maps.event.addDomListener(window, 'load', initialize);
</script>

@stop
