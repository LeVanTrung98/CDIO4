@extends('layout.user')

@section('header')
@endsection

@section('container')
<div class="container">
	<div class="row">
		<div class="col-2"></div>
		<div class="col-8">
			@if(!session('notificationF') && !session('notificationS'))
			<div class="alert alert-primary text-center">
				Tạo Mới Tài Khoản
			</div>
			@endif
			@if(session('notificationS'))
			<div class="alert alert-success text-center">
				{{session('notificationS')}}
			</div>
			@endif
			@if(session('notificationF'))
			<div class="alert alert-danger text-center">
				{{session('notificationF')}}
			</div>
			@endif
			<form action="{{route('user.store')}}" method="POST">
				@csrf
				<div class="row">
					<fieldset class="form-group col-6">
					<label for="formGroupExampleInput">Your Name <small class="text-danger">*</small></label>
					@if($errors->has('name'))
					<p class="text-danger">{{$errors->first('name')}}</p>
					@endif
					<input type="text" name="name" class="form-control" value="{{old('name')}}" required placeholder="Your Name...">
					</fieldset>
					<fieldset class="form-group col-6">
						<label for="formGroupExampleInput2">Your Email <small class="text-danger">*</small></label>
						@if($errors->has('email'))
						<p class="text-danger">{{$errors->first('email')}}</p>
						@endif
						<input type="email" required name="email" value="{{old('email')}}" class="form-control" placeholder="Your Email...">
					</fieldset>
				</div>
				<div class="row">
					<fieldset class="form-group col-6">
						<label for="formGroupExampleInput2">Your Password <small class="text-danger">*</small></label>
						@if($errors->has('password'))
						<p class="text-danger">{{$errors->first('password')}}</p>
						@endif
						<input type="password" required name="password" class="form-control" placeholder="Your Password...">
					</fieldset>
					<fieldset class="form-group col-6">
						<label for="formGroupExampleInput2">Your Address <small class="text-danger">*</small></label>
						@if($errors->has('address'))
						<p class="text-danger">{{$errors->first('address')}}</p>
						@endif
						<input type="text" required name="address" value="{{old('address')}}" class="form-control" placeholder="Your Address...">
					</fieldset>
				</div>

					<fieldset class="form-group">
						<label for="formGroupExampleInput2">Your Number Phone <small class="text-danger">*</small></label>
						@if($errors->has('phone'))
						<p class="text-danger">{{$errors->first('phone')}}</p>
						@endif
						<input type="number" value="{{old('phone')}}" required minlength="4" maxlength="11" name="phone" class="form-control" placeholder="Your Number Phone...">
					</fieldset>
				<fieldset class="form-group">
					<input type="submit" class="form-control btn btn-success" value="Submit">
				</fieldset>
				
			</form>
		</div>
	</div>
</div>
@endsection