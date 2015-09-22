@extends('layouts.default_landing')

@section('content')

<section class="bg bg-grey c-fff ta-center" style="padding: 80px 50px;">
	<div class="container">
		<div class="vertical-center">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="embed-responsive embed-responsive-16by9">
					  <iframe class="embed-responsive-item" src="//player.vimeo.com/video/104232037" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<h2 class="ta-center">When I donate and you donate together, <span class="c-blue">weDonate</span> more.</h2>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="carousel-cause">

    <h1>Choose a cause</h1>

    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide" >
                <div id="cause1" class="image" style="background-image:url(http://placehold.it/500x300)"></div>
                <p class="caption">Our focus cause this month</p>
            </div>
            <div class="swiper-slide" >
                <div id="cause2" class="image" style="background-image:url(http://placehold.it/500x300)" ></div>
                <p class="caption">...</p>
            </div>
            <div class="swiper-slide" >
                <div id="cause3" class="image" style="background-image:url(http://placehold.it/500x300)" ></div>
                <p class="caption">...</p>
            </div>
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

</section>

<section class="bg ta-center choose-a-cause" style="padding: 80px 50px;">
	<div class="container">
		<div class="vertical-center">
			<div class="row mb-1">
				<div class="col-sm-12">
					<div class="slick">
						@foreach($causeofthemonth as $cause)
					  	<div>
								<img src="/uploads/ci/{{ $cause->cause->image }}" style="width: 100%;">
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="select-container">
						<select id="choose-a-cause">
							<option>Search for a cause</option>
							@foreach($causes as $cause)
			        	<option value="{{ $cause->uuid }}" data-name="{{ $cause->name }}">{{ $cause->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="bg bg-blue donate-ripple c-fff" style="padding: 120px 50px;">
	<div class="container">
		<div class="vertical-center">
			<div class="row">
				<div class="col-sm-12">
					<div class="choose">
						<h1>Choose an amount: <input value="7"> <span class="label label-danger d-none">Minimum of $7</span></h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-12 ta-center">
					<div class="ripple">
						<img src="/img/DonatePag-Sec4.jpg">
						<div class="values keep">
							<input value="$1">
						</div>
						<div class="values iDonate">
							<input value="$1">
						</div>
						<div class="values uDonate">
							<input value="$2">
						</div>
						<div class="values weDonate">
							<input value="$3">
						</div>

						@if (Auth::check())
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#global-donate-popup">Donate Now</a>
						@else
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#global-connect-popup">Donate Now</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ta-center">
	<div class="container full-size">
		<div class="vertical-center">
		 	<div class="row">
				<div class="col-sm-12">
					<img src="/img/DonatePag-Sec5.jpg" class="img-100">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="bg ta-center" style="background-image: url('img/DonatePag-Sec6.jpg'); padding: 150px 50px;">
	<div class="container full-size">
		<div class="vertical-center">
		 	<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<h1>By sharing <span style="color: #4bc8f4">weDonate.org</span> with your online networks, you can create a ripple effect of change in the world</h1>
					<h3 class="ta-right"><span style="color: #4bc8f4">Mick Goschnick</span> (CEO @ weDonate.org)</h3>
				</div>
			</div>
		</div>
	</div>
</section>


@stop

@section('js')

@stop
