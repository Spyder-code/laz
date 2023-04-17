<!DOCTYPE html>
<html lang="en">
	<head>
		<title>LAZ | Nurul Falah</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
        <meta name="description" content="Ayo tebar kebaikan dengan jadi Donatur di Nurul Falah"/>
        <style>
            body{
                background-image: url('images/home.jpg');
            }
            [data-theme="dark"] body {
                background-image: url('images/home.jpg');
            }
        </style>
	</head>
	<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-column-fluid flex-lg-row">
				<div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
					<div class="d-flex flex-column">
						{{-- <a href="/" class="mb-7">
							<img alt="Logo" src="{{ asset('images/logo.png') }}" />
						</a> --}}
						{{-- <h2 class="text-white fw-normal m-0">Branding tools designed for your business</h2> --}}
					</div>
				</div>

				<div class="d-flex flex-center w-lg-50 p-10">
					<div class="card rounded-3 w-md-550px border border-success">
						<div class="card-body p-10 p-lg-20">
							@yield('content')
						</div>
					</div>
				</div>
			</div>
		</div>
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
	</body>
</html>
