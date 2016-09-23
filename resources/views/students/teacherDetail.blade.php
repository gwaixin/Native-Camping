@extends('common.students')

@section('contentMain')
	<h2>TEACHER DETAIL</h2>
	<div class="row">
		<div class="col-lg-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><div class="status-circle status-{{$status}} pull-right"></div> Teacher {{$teacher->fname}} {{$teacher->mname}} {{$teacher->lname}}</h4>
				</div>
				<div class="panel-body">
					<dl>
						<dt>Address :</dt>
						<dd><span>{{$teacher->address}}</span></dd>
						<dt>Country :</dt>
						<dd><span>{{$teacher->country}}</span></dd>
					</dl>
					<form class="start-form" action="/student/lesson" method="post">
						{!! csrf_field() !!}
						<input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
						<input type="hidden" name="chat_hash" value="{{ $onair->chat_hash }}">
						<button type="submit" class="btn btn-md btn-primary {{$status === 'standby' ? '' : 'disabled'}}" name="button">Start Lesson</button>
					</form>
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