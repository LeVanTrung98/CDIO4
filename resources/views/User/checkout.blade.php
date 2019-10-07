@extends('layout.user')

@section('header')
@endsection

@section('container')
<div class="container">
	<div class="row">
		<div class="col-2"></div>
		<div class="col-8">
			<div class="alert alert-primary text-center">Xác Nhận Tài Khoản</div>
			<form action="{{route('checkRegisterUser')}}" method="post">
				@csrf
				<fieldset class="form-group">
					<label for="formGroupExampleInput">Your Email <small class="text-danger">*</small></label>
					@if($errors->has('email'))
						<p class="text-danger">{{$errors->first('email')}}</p>
					@endif
					@if(session()->has('error'))
						<p class="text-danger">{{session('error')}}</p>
					@endif
					<input type="email" name="email" value="{{old('email')}}" required class="form-control" id="formGroupExampleInput" placeholder="Your Email...">
				</fieldset>
				<fieldset class="form-group">
					<label for="formGroupExampleInput2">Your Password <small class="text-danger">*</small></label>
					@if($errors->has('password'))
						<p class="text-danger">{{$errors->first('password')}}</p>
					@endif
					@if(session()->has('errorP'))
						<p class="text-danger">{{session('errorP')}}</p>
					@endif
					<input type="password" name="password" required class="form-control" id="formGroupExampleInput2" placeholder="Your Password...">
				</fieldset>
				<fieldset class="form-group">
					<input type="submit" class="form-control btn btn-success" id="formGroupExampleInput2" value="Xác Nhận Tài Khoản">
				</fieldset>
			</form>
		</div>
		
	</div>
</div>
@endsection