@extends('layout.user')

@section('header')

@endsection


@section('container')
	<div class="container">
		<div class="row">
			<div class="col-2"></div>
			<div class="col-8">
				@if(session()->has('success'))
					<div class="alert alert-success text-center">{{session('success')}}</div>
				@endif
				@if(!session()->has('success'))
					<div class="alert alert-primary text-center">Login</div>
				@endif
				<form action="{{route('login')}}" method="post">
					@csrf
					<input type="hidden" name="path" value="{{session('path')}}">
					<fieldset class="form-group">
						<label for="formGroupExampleInput">Your Email...</label>
						@if($errors->has('email'))
							<p class="text-danger">{{$errors->first('email')}}</p>
						@endif
						@if(session()->has('error'))
							<p class="text-danger">{{session('error')}}</p>
						@endif
						<input type="email" required  name="email" value="{{old('email')}}" class="form-control" id="formGroupExampleInput" placeholder="Your Email...">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExampleInput2">Your Password</label>
						@if($errors->has('password'))
							<p class="text-danger">{{$errors->first('password')}}</p>
						@endif
						@if(session()->has('errorP'))
							<p class="text-danger">{{session('errorP')}}</p>
						@endif
						<input type="password" required name="password" class="form-control" id="formGroupExampleInput2" placeholder="Your Password...">
					</fieldset>
					<fieldset class="form-group">
						<input type="submit" class="form-control btn btn-success" value="Login">
					</fieldset>
				</form>
			</div>
		</div>
	</div>
@endsection