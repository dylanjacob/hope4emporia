<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"></meta>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"></meta>
		<meta name="viewport" content="width=device-width, initial-scale=1"></meta>
		<meta name="description" content="">
    	<meta name="author" content="">
    	<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

		<title>
			@yield('title')
		</title>

		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"></link>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"></link>
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    	<!-- Custom styles for this template -->
   		@if(Request::segment(1) == "a" || Request::segment(1) == "auth")
   		<link rel="stylesheet" href="/css/default.css"></link>
		@else
		<link href="/css/template2.css" rel="stylesheet">
		@endif

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

		@yield('scripts-head')
		@yield('styles')

		<!-- Temp Scripts REMOVE after Dev -->
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
		<meta http-equiv="pragma" content="no-cache" />

	</head>
	<body>
		@yield('navbar')
		@yield('carousel')
		@yield('content')
		@yield('foot')
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/holder/2.3.1/holder.min.js"></script>
    	<script src="/js/jquery.touch.min.js"></script>
		@yield('scripts')
	</body>
</html>