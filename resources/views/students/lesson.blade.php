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
		/* document ready */
		$(function() {
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
		});
		
		/* student's function */
		/**
		 * disconnecting lesson
		 * @param  {Object} data contains information about the disconnection
		 */
		function lessonDisconnect(data) {
			console.warn(data);
			
			/* prepare command */
			var command = (typeof data.command !== 'undefined') ? data.command : 'unknown';
			
			/* process the disconnection */
			switch (command) {
				
				/* teacher has suddenly stop the lesson by others */
				case constant.disconnect.teacher.others:
				 	console.warn('[SOCKET] teacher stopped lesson by others');
					window.location.href = '/student/teacher/' + connect.config.teacherID + "?action=lessonEnd";
					break;
				
				/* student will be notify by teacher's sudden disconnection */
				case constant.disconnect.teacher.sudden:
					console.warn('[SOCKET] teacher sudden disconnection ');
					break;
				
				/* teachers's connection to the socket server timed out */
				case constant.disconnect.teacher.timeOut :
					console.log('[SOCKET] Because the teacher was unable to reconnect within the alotted time, the system will automatically end the lesson.');
					
					/* redirect student to dashboard */
					setTimeout(function() { window.location.href = '/student?action=' + command ; }, 2000);
					break;
				
				/* if command is not found in any cases */
				default:
					console.log('[SOCKET] Unknown disconnection command -> ', command);
			}
		}
	</script>
@endsection