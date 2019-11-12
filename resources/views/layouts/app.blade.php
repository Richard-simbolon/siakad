<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
        <title>Siakad Login Page</title>
        
    <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
		<meta name="description" content="Login">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
        <link href="assets/css/pages/login/login-3.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	@yield('content')

	<!-- end::Body -->
</html>