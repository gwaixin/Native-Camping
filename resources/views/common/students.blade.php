@extends('base')

@section('title', ucfirst($title))

@section('nav')
	@include('/partials.students.nav')
@endsection

@section('content')
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					@yield('breadcrumbs')
					{{-- <ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Library</a></li>
					  <li class="active">Data</li>
					</ol> --}}
					@yield('contentMain')
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	@if (isset($scripts))
		@foreach ($scripts as $key)
{!! Html::script("js/" . $key . ".js") !!}
		@endforeach
	@endif
	@yield('scriptInternal')
{!! Html::script('js/angular/factories.js') !!}
@endsection
	
@section('styles')
{!! Html::style('css/simple-sidebar.css') !!}
{!! Html::style('css/users/common.css') !!}
@endsection