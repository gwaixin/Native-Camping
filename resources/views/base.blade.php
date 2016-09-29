<!DOCTYPE html>
<html lang="en" ng-app="ncApp" ng-cloak>
<head>
	<meta charset="UTF-8">
	<title>Native Camping Site : @yield('title')</title>
	<!-- DEFAULT STYLES -->
	{!! Html::style('css/default-libs.min.css') !!}
	<!-- ADDITIONAL STYLES -->
	@yield('styles')
</head>
<body {{isset($ngController) ? "ng-controller=$ngController" : "" }}>
	<div id="wrapper">
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
					<p>{!! session('message') !!}</p>
				</div>
			@endif
		</div>
		@yield('content')
	</div>
	<!-- DEFAULT SCRIPT -->
	{!! Html::script('js/default-libs.min.js') !!}
	{!! Html::script('js/angular/app.js') !!}
	<!-- ADDITIONAL SCRIPTS -->
	@yield('scripts')
</body>
</html>