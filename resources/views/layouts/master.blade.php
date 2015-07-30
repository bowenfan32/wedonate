<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<!-- CSS -->
	<!-- <link href="/lib/Skeleton-2.0.4/css/normalize.css" rel="stylesheet">
	<link href="/lib/Skeleton-2.0.4/css/skeleton.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	@yield('css_master')

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>

	@yield('content_master')

	<!-- Scripts -->
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<!-- <script src="https://checkout.stripe.com/checkout.js"></script> -->
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script src="{{ asset('/lib/parsley/parsley.min.js') }}"></script>
	<script src="{{ asset('/js/app.js') }}?v=1.1"></script>
	@yield('js_master')

</body>
</html>
