@extends('common.students')

@section('contentMain')
	<h2>TEACHER LIST</h2>
	<div class="" ng-controller="TeacherList">
		<div class="row teacher-lists">
			<div class="col-sm-2 teacher-view" ng-repeat="teacher in teachers">
				<a href="/student/teacher/<%=teacher.id%>">
					<figure><img src="http://placehold.it/50x50" alt="avatar" /></figure>
					<div class="teacher-info">
						<div class="status-circle status-default"></div>
						<p class="teacher-name">
							<span ng-bind="teacher.fname"></span> <span ng-bind="teacher.lname"></span>
						</p>
					</div>
				</a>
			</div>
		</div>
	</div>
@endsection

@section('breadcrumbs')
	{!! Breadcrumbs::render('teacherList') !!}
@endsection