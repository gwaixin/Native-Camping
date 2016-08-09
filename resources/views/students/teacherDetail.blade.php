@extends('common.students')

@section('contentMain')
	<h2>TEACHER DETAIL</h2>
	<div class="row">
		<div class="col-lg-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><div class="status-circle status-default pull-right"></div> Teacher {{$teacher->fname}} {{$teacher->mname}} {{$teacher->lname}}</h4>
				</div>
				<div class="panel-body">
					<dl>
						<dt>Address :</dt>
						<dd><span>{{$teacher->address}}</span></dd>
						<dt>Country :</dt>
						<dd><span>{{$teacher->country}}</span></dd>
					</dl>
					<button class="btn btn-md btn-primary" name="button">Start Lesson</button>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<figure>
				<img src="http://placehold.it/250x250" class="thumbnail" alt="" />
			</figure>
		</div>
	</div>
@endsection

@section('breadcrumbs')
	{!! Breadcrumbs::render('teacherDetail', $teacher->id) !!}
@endsection

@section('scripts')
	@parent
	{{-- your scripts --}}
@endsection