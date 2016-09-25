<!DOCTYPE html>
<html lang="en" font="CastroScript">
<head>
	<title>Welcome to @yield('title')</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="Keywords" content="appartment, room, rentals, rental, board, bording, house" />
	<meata name="description" content="Online Posting and Rentals of Appartments and Rooms" />
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
	<link rel="stylesheet" href="{{asset('css/bootstrap-social.css') }}"/>
	<link rel="stylesheet" href="{{asset('css/font-awesome.css') }}"/>
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css') }}"/> 
	<link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
	<script src="{{ asset('js/angular.min.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('css/w3.css') }}">
	<link rel="stylesheet" href="{{ asset('fonts/CastroScript.ttf')}}"/>
	<script src="{{ asset('js/modernizr.min.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
</head>
<body>

	@yield('content')

</body>
</html>