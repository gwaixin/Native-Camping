@extends('base')

@section('title', ucfirst($title))

@section('nav')
	@include('/partials.teachers.nav')
@endsection

@section('content')
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					@yield('contentMain')
				</div>
			</div>
		</div>
	</div>
@endsection

@section('styles')
	{!! Html::style('css/simple-sidebar.css') !!}
	{!! Html::style('css/teachers/main.css') !!}
@endsection

@section('scripts')
	@if (isset($scripts))
		@foreach ($scripts as $key)
{!! Html::script("js/" . $key . ".js") !!}
		@endforeach
	@endif
	
@yield('scriptInternal')
@endsection