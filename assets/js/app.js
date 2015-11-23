// GlOBALS
const SITEURL = 'http://localhost:8000';
//const SITEURL = 'http://wedonate.org';

// Redirect after X amount of seconds
function countdown_redirect(url) {
	window.setTimeout(function () {
    window.location.href = url;
  }, 2000);
}

// Stripe Handler
function stripeResponseHandler(status, response) {
  var $form = $('#global-donate-popup form');

  if (response.error) {
    // Show the errors on the form
    $form.find('.payment-errors').text(response.error.message);
    $form.find('button').prop('disabled', false);
		$button.after('<div class="spinner d-none mt-1""><div class="double-bounce1"></div><div class="double-bounce2"></div></div>');
		$form.find('.spinner').fadeIn('fast');

  } else {
    // response contains id and card, which contains additional card details
    var token = response.id;
    // Insert the token into the form so it gets submitted to the server
    $form.append($('<input type="hidden" name="token_id" />').val(token));

		// For card saving
		if ($form.find('input[name="save_card"]').is(':checked')) {
			console.log('savecard');
	    $form.append($('<input type="hidden" name="gateway" />').val('stripe'));
	    $form.append($('<input type="hidden" name="customer_id" />').val(response.source.id));
	    $form.append($('<input type="hidden" name="last4" />').val(response.source.last4));
	    $form.append($('<input type="hidden" name="brand" />').val(response.source.brand));
	    $form.append($('<input type="hidden" name="exp_month" />').val(response.source.exp_month));
	    $form.append($('<input type="hidden" name="exp_year" />').val(response.source.exp_year));
		}

		console.log(response);

		// and submit
    $form.get(0).submit();
  }
};

function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return sParameterName[1];
        }
    }
}

$(document).ready(function() {
    window.setTimeout(function () {
        var r = getUrlParameter('r');
        if (window.location.href == SITEURL) {
            $('#global-connect-popup #registerForm input[name=referrer]').val(r);
        }
    }, 1);
	// Global Connect
	$(document).on('submit', '#global-connect-popup #loginForm', function(e) {
		e.preventDefault();
		$form = $(this);
		$button = $(this).find('button');
		$data = $(this).serialize();
		$button.attr('disabled', 'disabled');
		$button.after('<div class="spinner d-none mt-1""><div class="double-bounce1"></div><div class="double-bounce2"></div></div>');
		$form.find('.spinner').fadeIn('fast');
		$form.find('.form-errors li').fadeOut('fast');
		$form.find('.form-errors').empty();

		const url = SITEURL + '/connect/a/login';

		$.ajax({
			type: 'POST',
			url: url,
			data: $data, // serializes the form's elements.
			success: function(data) {
				if ((data.success == 1) && data.redirect) {
					countdown_redirect(data.redirect);
				}
				else if (data.success == 0) {
					window.setTimeout(function () {
						$button.removeAttr('disabled');
						$form.find('.spinner').fadeOut('fast', function() {
							$(this).remove();
							$form.find('.form-errors').append('<li class="d-none">Your username or password is incorrect.</li>');
							$form.find('.form-errors li').fadeIn('fast');
						});
				  }, 2000);
				}
			}
     });

	});

	// Regsiter
	$(document).on('submit', '#global-connect-popup #registerForm', function(e) {
		e.preventDefault();

		$form = $(this);
		$button = $(this).find('button');
		$data = $(this).serialize();

		$button.attr('disabled', 'disabled');
		$button.after('<div class="spinner d-none mt-1""><div class="double-bounce1"></div><div class="double-bounce2"></div></div>');
		$form.find('.spinner').fadeIn('fast');
		$form.find('.form-errors li').fadeOut('fast');
		$form.find('.form-errors').empty();

		const url = SITEURL + '/connect/a/register';
		$.ajax({
			type: 'POST',
			url: url,
			data: $data, // serializes the form's elements.
			success: function(data) {
				if ((data.success == 1) && data.redirect) {
					countdown_redirect(data.redirect);
				}
				else if (data.success == 0) {
					window.setTimeout(function () {
						$button.removeAttr('disabled');
						$form.find('.spinner').fadeOut('fast', function() {
							$(this).remove();
							$form.find('.form-errors').append('<li class="d-none">Unable to register.</li>');
							$form.find('.form-errors li').fadeIn('fast');
						});
				  }, 2000);
					$form.find('.form-errors').append('<li class="d-none">' +  data.messages + '</li>');
					$form.find('.form-errors li').fadeIn('fast');
				}
				else {
					window.setTimeout(function () {
						$button.removeAttr('disabled');
						$form.find('.spinner').fadeOut(100, function() {
							$(this).remove();
							$form.find('.form-errors').append('<li class="d-none">Unable to register.</li>');
							$form.find('.form-errors li').fadeIn('fast');
						});
				  }, 2000);
				}
			}
     });
	});
	// Global Donate
	Stripe.setPublishableKey('pk_test_4Mw3HArEb1pwu6VjJFRYJx4v');
	//Stripe.setPublishableKey('pk_live_4Mw3QcIDxE5B8cxqhCAAWTY7');
	$(document).on('submit', '#global-donate-popup form', function(e) {
    var $form = $(this);
    // Disable the submit button to prevent repeated clicks
    $form.find('button').prop('disabled', true);
    Stripe.card.createToken($form, stripeResponseHandler);

    // Prevent the form from submitting with the default action
    return false;
  });

	// Form Vaidates

	
	$(document).on('input', '#global-donate-popup form input',function() {
		var $input = $(this);

		if ($input.attr('data-stripe') == 'number') {
			if (Stripe.card.validateCardNumber($input.val())) {
				$input.css('border-color', '#ccc');
			}
			else {
				$input.css('border-color', 'red');
			}
		}
		else if ($input.attr('data-stripe') == 'exp-month') {
			if (Stripe.card.validateExpiry($('#global-donate-popup form').find('[data-stripe="exp-month"]').val(), $('#global-donate-popup form').find('[data-stripe="exp-year"]').val())) {
				$('#global-donate-popup form').find('[data-stripe="exp-month"]').css('border-color', '#ccc');
				$('#global-donate-popup form').find('[data-stripe="exp-year"]').css('border-color', '#ccc');
			}
			else {
				$('#global-donate-popup form').find('[data-stripe="exp-month"]').css('border-color', 'red');
				$('#global-donate-popup form').find('[data-stripe="exp-year"]').css('border-color', 'red');
			}
		}
		else if ($input.attr('data-stripe') == 'exp-year') {
			if (Stripe.card.validateExpiry($('#global-donate-popup form').find('[data-stripe="exp-month"]').val(), $('#global-donate-popup form').find('[data-stripe="exp-year"]').val())) {
				$('#global-donate-popup form').find('[data-stripe="exp-month"]').css('border-color', '#ccc');
				$('#global-donate-popup form').find('[data-stripe="exp-year"]').css('border-color', '#ccc');
			}
			else {
				$('#global-donate-popup form').find('[data-stripe="exp-month"]').css('border-color', 'red');
				$('#global-donate-popup form').find('[data-stripe="exp-year"]').css('border-color', 'red');
			}
		}
	});
	// Close Checkout on page navigation
	$(window).on('popstate', function() {
		handler.close();
	});
	
	
	if ($('.action').html() == '') {
		$action = $('.action');
		$action.fadeIn('slow');
	}

	function fix_navbar_top() {
		var styles = {'position': 'fixed', 'top': '0', 'bottom': 'auto', 'margin-top': 'auto', 'width': '100%'};
		$('.landing-navbar').css(styles);
	}
	
	function reset_navbar() {
		var styles = {'position': 'relative', 'margin-top': '-90px'};
		$('.landing-navbar').css(styles);
	}

	$(document).scroll(function() {

		var scroll_top = $(this).scrollTop();

		// On scroll, move the navbar to the right position
		if (($('#landing-section').length)) {
			if ((scroll_top > ($('#landing-section').outerHeight()) - 90)) {
				fix_navbar_top();
				$('.landing-navbar').children().addClass('fixed');
			}
			else {
				reset_navbar();
				$('.landing-navbar').children().removeClass('fixed');
			}
		}
			console.log(scroll_top);
			console.log($('#landing-section').outerHeight());
	});

	reset_navbar();

	// Google Anal
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	/*
	* readable-random
	* https://github.com/anthonyringoet/readable-random
	*
	* Copyright (c) 2012 Anthony Ringoet
	* Licensed under the MIT license.
	*/

	function get_random_string(length) {
		var priv = {};
		priv.consonants = ['b','c','d','f','g','h','j','k','l','m','n','p','r','s','t','v','w'];
		priv.vowels = ['a', 'e', 'i', 'o', 'u', ' '];
		priv.result = '';

		priv.getLetter = function(datasource){
			var key = Math.floor(Math.random() * datasource.length);
			return datasource[key];
		};

		// default and go
		var loopStat = 0;
		if(!length){
			length = 6;
		}

		while (loopStat < length){
			if(loopStat === null || loopStat % 2){
				priv.result += priv.getLetter(priv.vowels);
			}
			else{
				priv.result += priv.getLetter(priv.consonants);
			}
			loopStat++;
		}

		return priv.result;
	};

	/*
	Love and Money - Scramble
	*/
	function scramble( $e, text, url, time ) {
		var length = $e.text().length;
		var difference = ( length - text.length ) * -1;

		// not the actual number of steps, but how many iterations to wait before incrementing the step
		var steps = Math.ceil( ( difference == 0 ) ? 0 : time / Math.abs( difference ) );
		var step = steps;
		var count = 0;

		var interval = setInterval(function() {
			var temp_text = "";
			var possible = "abcdefghijklmnopqrstuvwxyz ";

			// for( var i=0; i < length; i++ )
			// temp_text += possible.charAt(Math.floor(Math.random() * possible.length));
			temp_text = get_random_string( length );

			if ( count == step ) {
				step = steps + step; // increment step
				length += ( difference > 0 ) ? 1 : -1;
			}

			$e.html( temp_text.replace(/ /g, "&nbsp;") );

			if ( count++ > time ) {
				clearInterval( interval );
				$e.text( text );

				if ( url != '' ) {
					$e.attr('href', url);
				}
			}
		}, 35);
	}

	function init_interval( $e, words ) {
		setInterval(function() {
			if ( $e.hasClass('paused') ) return;
			var word;
			var url = '';

			// don't use the same word twice in a row
			do {
				word = words[Math.floor(Math.random() * words.length)];
				if ( typeof word !== 'string' ) {
					url = word[1];
					word = word[0]
				}
			}
			while ( word == $e.text() );

			scramble( $e, word, url, 20 );
		}, Math.random() * 8000 + 10000);
	}

	var online = ["An online", "A mobile", "An innovative"];
	var social = ["network", "enterprise", "consultancy"];
	var people = ["people", "users", "students", "professionals", "change-makers", "advocates", "leaders"];
	var give = ["give", "volunteer", "donate", "offer"];
	var more = ["time.", "money.", ""];

	init_interval( $('.scramble.online'), online );
	init_interval( $('.scramble.social'), social );
	init_interval( $('.scramble.people'), people );
	init_interval( $('.scramble.give'), give );
	init_interval( $('.scramble.more'), more );

	// Calculate the donate

	$('.donate-ripple .choose input').on('input paste copy cut keyup keydown', function(event) {
		if (event.keyCode >= 48 && event.keyCode <= 57 && current.val() >= 7) {
			

			// $('.amount-error').html('');
			// $('.amount-error').removeClass('alert alert-danger');

			var my_amount = $(this).val();
			var iDonate = 14.285714285714286 * my_amount / 100;
			var uDonate = 28.571428571428573 * my_amount / 100;
			var weDonate = 42.857142857142854 * my_amount / 100;
			var retain = 14.28 * my_amount / 100;
			$('.donate-ripple .ripple .keep input').val('$' + parseFloat(iDonate).toFixed(1));
			$('.donate-ripple .ripple .iDonate input').val('$' + parseFloat(iDonate).toFixed(1));
			$('.donate-ripple .ripple .uDonate input').val('$' + parseFloat(uDonate).toFixed(1));
			$('.donate-ripple .ripple .weDonate input').val('$' + parseFloat(weDonate).toFixed(1));

			$('.donate-form input[name=amount]').val(my_amount);
		}
		// if amoutn less than 7
		else {
        // $('.amount-error').addClass('alert alert-danger');
        // $('.amount-error').html('Please enter an amount greater than $7.');
		}
	});

});

//Navigation//
var slideout = new Slideout({
    'panel': document.getElementById('panel'),
    'menu': document.getElementById('menu'),
    'padding': 256,
    'tolerance': 70,
    'side': 'right'
});

//Nav toggles//
$('.toggle-button').on('click', function() {
    slideout.toggle();
    $('.toggle-button').toggleClass('fa-bars');
    $('.toggle-button').toggleClass('fa-times');
});
$('.fa-share-alt').on('click', function() {
    $('.overlay').addClass('show');
});
$('.fa-times').on('click', function() {
    $('.overlay').removeClass('show');
});

function navigate(id) {

    $('html, body').animate({
        scrollTop: $('#'+id).offset().top
    }, 2000);

}



//Carousel//
var swiper = new Swiper('.swiper-container', {
    effect: 'coverflow',
    centeredSlides: true,
    slidesPerView: 'auto',
    paginationClickable: true,
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    spaceBetween: 30,
    coverflow: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows : true
    }
});
$(".carousel-cause .image").click(function(){

    $(".carousel-cause .image").removeClass('selected');
    $("#"+this.id).addClass('selected');

});