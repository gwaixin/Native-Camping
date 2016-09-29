@extends('common.teachers')

@section('contentMain')
	<h2>TEACHER LESSON : <small>{{ $status }}</small> </h2>
	<hr>
	<div class="row">
		<div class="col-lg-4">
			<a href="javascript:;" ng-click="toOthers()">go to others</a>
		</div>
		<div class="col-lg-8">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6">
							<b>my video</b> <br>
							<video class="videoWrap ownVideo" id="ownVideo" style="background-color: black;" autoplay muted></video>
						</div>
						<div class="col-lg-6">
							<b>student's video</b> <br>
							<video class="videoWrap othersVideo" id="othersVideo" style="background-color: black;" autoplay muted></video>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<b>chatbox</b>
					<table class="chatarea" style="height: 150px;">
						
					</table>
					<div class="row">
						<div class="col-lg-10">
							<input type="text" class="form-control" name="name" value="">
						</div>
						<div class="col-lg-2">
							<input type="button" class="btn btn-default" value="Send">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scriptInternal')
	<script type="text/javascript">
	/* get angular controller element */
	var ngLesson = angular.element($("[ng-controller='Lesson']"));
	
	/* document ready */
	$(function(){
		/* check if scope exist in ngLesson */
		if (typeof ngLesson !== 'undefined') {
			/* setup config */
			connect.config = {
				memberType: "teacher",
				chatHash: "{{ $chatHash }}",
				teacherID: "{{ $teacherID }}",
				userID: 0,
				lessonType: "1",
				peerID: "TEACHER-{{ $teacherID }}",
				workstationID: 8,
				ipAddress: "{{ $ipAdress }}",
				firstTime: 1,
				deviceType: "pc"
			};
			ngLesson = ngLesson.scope();
			ngLesson.init();
		} else {
			console.warn('[NG] element is undefined, cannot get scope to undefined element');
		}
	});
	</script>
@endsection