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
			</div>
		</div>
		<div class="col-lg-4">
			chat area
		</div>
	</div>
@endsection

@section('scriptInternal')
	<script type="text/javascript">
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
		
		/* initialize student connection */
		connect.init(
			/* connected to the server */
			function(conn) {
				/* initialize the common events */
				eventCommon.init();
				
				/* initialize events */
				eventStudent.init();
				
				/* conntect to room */
				eventCommon.connectToRoom();
			},
			
			/* unable to initialize connection */
			function(error, conn) {
				// TODO
			}
		);
	</script>
@endsection