@extends('common.students')

@section('contentMain')
	<h2>{{ $title }}</h2>
	<div class="row">
		<div class="col-lg-8">
			<div class="row">
				<div class="col-lg-12">
					<b>my video</b> <br>
					<video class="videoWrap ownVideo" id="ownVideo" style="background-color: black;" autoplay muted></video>
				</div>
				<div class="col-lg-12">
					<b>teacher's video</b> <br>
					<video class="videoWrap othersVideo" id="othersVideo" style="background-color: black;" autoplay muted></video>
				</div>
				<div class="col-lg-12">
					<a href="javascript:;" ng-click="endLesson()">End Lesson</a>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			chat area
		</div>
	</div>
@endsection

@section('scriptInternal')
	<script type="text/javascript">
		/* get angular controller element */
		var ngLesson = angular.element($("[ng-controller='Lesson']"));
		/* document ready */
		$(function() {
			/* check if scope exist in ngLesson */
			if (typeof ngLesson !== 'undefined') {
				/* check if scope exist in ngLesson */
				connect.config = {
					memberType: "student",
					chatHash: "{{ $onair->chat_hash }}",
					teacherID: "{{ $onair->teacher_id }}",
					userID: "{{ $onair->student_id }}",
					lessonType: "{{ $onair->lesson_type }}",
					peerID: "STUDENT-{{ $onair->student_id }}",
					onairID: "{{ $onair->id }}",
					studentName: "{{ $user->fname }} {{ $user->lname }}",
					deviceType: 'pc'
				};
				ngLesson = ngLesson.scope();
				ngLesson.init();
			} else {
				console.warn('[NG] element is undefined, cannot get scope to undefined element');
			}
		});
	</script>
@endsection