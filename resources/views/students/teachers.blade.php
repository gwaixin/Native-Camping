@extends('common.students')

@section('contentMain')
	<div class="" ng-controller="TeacherList">
		<h3>Teacher LIST</h3>
		<hr>
		<div class="row teacher-lists">
			<div class="col-sm-2 teacher-view" ng-repeat="teacher in teachers">
				<a href="#">
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

@section('scripts')
	@parent
	{!! Html::script('js/angular/controller/student/teacher-list.js') !!}
@endsection