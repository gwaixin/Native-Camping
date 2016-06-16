@extends('common.landing')

@section('content')
<div class="col-lg-12">
	<h2>Registration</h2>
	<form action="/register" method="POST" class="form-horizontal">
		<div class="form-group">
			<label for="firstname" class="control-label col-lg-2">Firstname</label>
			<div class="col-lg-10">
				<input type="text" id="firstname" name="firstname" placeholder="firstname" class="form-control" value="{{Input::old('firstname')}}" autofocus>
			</div>
		</div>
		<div class="form-group">
			<label for="lastname" class="control-label col-lg-2">Lastname</label>
			<div class="col-lg-10">
				<input type="text" id="lastname" name="lastname" value="{{Input::old('lastname')}}" placeholder="lastname" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="email" class="control-label col-lg-2">Email</label>
			<div class="col-lg-10">
				<input type="email" id="email" name="email" value="{{Input::old('email')}}" placeholder="email" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="password" class="control-label col-lg-2">Password</label>
			<div class="col-lg-10">
				<input type="password" id="password" name="password" value="{{Input::old('password')}}" placeholder="password" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="confirm_password" class="control-label col-lg-2">Confirm Password</label>
			<div class="col-lg-10">
				<input type="password" id="confirm_password" name="confirm_password" value="{{Input::old('confirm_password')}}" placeholder="confirm_password" class="form-control">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			</div>
		</div>
		<div class="form-group">
			<label for="type" class="control-label col-lg-2">Type</label>
			<div class="col-lg-10">
				<div class="radio">
					<label for="student" class="control-label col-lg-1">
						<input type="radio" name="type" id="student" value="student"> Student
					</label>
					<label for="teacher" class="control-label col-lg-1">
						<input type="radio" name="type" id="teacher" value="teacher"> Teacher
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
				<button class="btn btn-primary" type="submit">Submit</button>
			</div>
		</div>
	</form>
</div>
@endsection