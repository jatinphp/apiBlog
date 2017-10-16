<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Blog Laravel</title>

	<link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="{{ url('css/blog.css') }}" rel="stylesheet">
</head>

<body>

@include('layouts.nav')

@yield('title')

<div class="container">

	<div class="row">

		<div class="col-sm-8 blog-main">

			@yield('content')

		</div>

			@include('layouts.sidebar')

	</div>

</div>

@include('layouts.footer')