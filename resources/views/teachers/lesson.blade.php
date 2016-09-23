@extends('common.teachers')

@section('contentMain')
	<h2>LESSON</h2>
	<hr>
	<div class="row">
		<div class="col-lg-4">
			<h3>MENU</h3>
			<select class="" name="">
				<option value="option">option1</option>
				<option value="option2">option2</option>
				<option value="option3">option3</option>
				<option value="option4">option4</option>
				<option value="option5">option<5/option>
			</select>
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
	/* document ready */
	$(function(){
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
		
		connect.init(
			/* connected to the server */
			function(conn) {
				/*initialize camera */
				connect.intitializeCamera(function() {
						/* initialize events */
						eventCommon.init();
						
						/* initialize events */
						eventTeacher.init();
						
						/* initialize teacher events */
						eventCommon.connectToRoom();
				
				/* catch when no camera is detected */
				}, function() {
					console.log('Cannot detect camera');
				});
			},
			
			/* fail to connect to socket */
			function(error, conn) {
				console.warn('ERROR to connect socket:', error, conn);
			}
		);
	});
	</script>
@endsection