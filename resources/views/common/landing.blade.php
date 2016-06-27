@extends('base')

@section('title', ucfirst($title))

@section('nav')
	@include('/partials.landing.nav')
@endsection

@section('content')
	<div class="container">
		@yield('contentMain')
	</div>
@endsection