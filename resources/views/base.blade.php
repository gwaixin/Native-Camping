<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Native Camping Site : @yield('title')</title>
	<!-- DEFAULT STYLES -->
	{!! Html::style('css/default-libs.min.css') !!}
</head>
<body>
	@yield('nav')
	<div class="container">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@elseif (session('customError'))
			<div class="alert alert-danger">
				<p>{{ session('customError') }}</p>
			</div>
		@elseif (session('message'))
			<div class="alert alert-success">
				<p>{{ session('message') }}</p>
			</div>
		@endif

		@yield('content')
	</div>
	<!-- DEFAULT SCRIPT -->
	{!! Html::script('js/default-libs.min.js') !!}
</body>
</html>