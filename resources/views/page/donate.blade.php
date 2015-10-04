@extends('layouts.default_landing')

@section('content')

<section id="donate" class="carousel-cause">

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

<section class="bg bg-blue donate-ripple c-fff" style="padding: 120px 50px;">
	<div class="container full-size">
		<div class="vertical-center">
			<div class="row">
				<div class="col-sm-12">
					<div class="choose">
						<h1>Choose an amount: <input value="7"></h1>
					</div>
				</div>
			</div>
			<div class="row">
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


@stop

@section('js')

@stop
