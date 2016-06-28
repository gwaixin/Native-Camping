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
					@yield('contentMain')
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
{!! Html::script('js/angular/factories.js') !!}
@endsection
	
@section('styles')
{!! Html::style('css/simple-sidebar.css') !!}
{!! Html::style('css/users/common.css') !!}
@endsection