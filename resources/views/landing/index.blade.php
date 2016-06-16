@extends('common.landing')

@section('content')

<div class="col-lg-12">
	<h2>Welcome to Native Camping</h2>
	<hr>
	<form action="/login" method="POST" class="form-horizontal">
		<div class="form-group">
			<label class="control-label col-lg-3" for="email">Email</label>
			<div class="col-lg-5">
				<input type="email" required class="form-control" placeholder="eg. your@email.com" id="email" name="email" value="{{Input::old('email')}}">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3" for="password">Password</label>
			<div class="col-lg-5">
				<input type="password" required class="form-control" placeholder="your password" id="password" name="password">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-offset-3 col-lg-5">
				<button class="btn btn-primary">Login</button>
			</div>
		</div>
	</form>
</div>

@endsection