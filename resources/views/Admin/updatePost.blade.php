@extends('layout.admin')


@section('content')
<div class="container">
	@if(session()->has('success'))
    	<div class="alert alert-success text-center">
        	{{session('success')}}
    	</div>
    @endif
	<form action="{{route('adminUpdatePost')}}" method="post">
		@csrf
		<input type="hidden" name="id" value="{{$id}}">
		<div class="container">
		<div class="row">
			<div class="col-6">
				<fieldset class="form-group">
					<label for="formGroupExampleInput">Tên tiêu đề <small class="text-danger">*</small></label>
					@if($errors->has('title'))
		                <p class="text-danger">{{$errors->first('title')}}</p>
		            @endif
		            <input type="text" name="title" value="{{$post->title}}" class="col-12" placeholder="Cho thuê phòng trọ, địa chỉ ở đâu...">
				</fieldset>
			</div>
			<div class="col-6">
				<fieldset class="form-group">
					<label for="formGroupExampleInput">Mô tả <small class="text-danger">*</small></label>
					 @if($errors->has('content'))
		                <p class="text-danger">{{$errors->first('content')}}</p>
		            @endif
		            <textarea id="Field4" name="content" spellcheck="true" rows="2" cols="50" tabindex="4" placeholder="Mô tả thêm thông tin, giá cả, tiện ích, quy định...">{{$post->content}}</textarea>
				</fieldset>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<fieldset class="form-group">
					<label for="formGroupExampleInput">Quận/Huyện <small class="text-danger">*</small></label>
					 @if($errors->has('district'))
		            	<p class="text-danger">{{$errors->first('district')}}</p>
		        	@endif
		            <select id="sel-option" name="district" class="sel-option">
		                <option selected="selected" value="0">QUẬN/HUYỆN</option>
		                <option value="" class="seperator" disabled="disabled">-----</option>
		                @foreach($district as $key=>$val)
		                    @if($val->id == $idDistrict)
		                        <option value="{{$val->id}}" selected>{{$val->name}}</option>
		                    @else
		                    <option value="{{$val->id}}">{{$val->name}}</option>
		                    @endif
		                @endforeach
		            </select>
				</fieldset>
			</div>
			<div class="col-6">
				<fieldset class="form-group">
					<label for="formGroupExampleInput">Phường <small class="text-danger">*</small></label>
					@if($errors->has('ward'))
			            <p class="text-danger">{{$errors->first('ward')}}</p>
			        @endif
			            <select id="sel-option" name="ward" class="sel-option">
			                <option selected="selected" value="0">PHƯỜNG</option>
			                <option value="" class="seperator" disabled="disabled">-----</option>
			                @foreach($ward as $key=>$val)
			                    @if($val->id == $idWard)
			                        <option value="{{$val->id}}" selected>{{$val->name}}</option>
			                    @else
			                    <option value="{{$val->id}}">{{$val->name}}</option>
			                    @endif
			                @endforeach
			            </select>
				</fieldset>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<fieldset class="form-group">
					<label for="formGroupExampleInput">Địa chỉ <small class="text-danger">*</small></label>
					@if($errors->has('address1'))
		                <p class="text-danger">{{$errors->first('address1')}}</p>
		            @endif
		            <input type="text" name="address1" class="col-10" value="{{$post->address}}" placeholder="Địa chỉ phòng trọ ở đâu...">
				</fieldset>
			</div>
			<div class="col-6">
				<fieldset class="form-group">
					<label for="formGroupExampleInput">Diện tích <small class="text-danger">*</small></label>
					@if($errors->has('area'))
		                <p class="text-danger">{{$errors->first('area')}}</p>
		            @endif
		            <input type="text" name="area" value="{{$post->area}}" class="col-10" placeholder="Diện tích phòng bao nhiêu...">
				</fieldset>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<fieldset class="form-group">
					<label for="formGroupExampleInput">Giá <small class="text-danger">*</small></label>
					 @if($errors->has('price'))
		                <p class="text-danger">{{$errors->first('price')}}</p>
		            @endif
		            <input type="number" step="0.001" name="price" value="{{$post->price}}" class="col-10" placeholder="Giá phòng bao nhiêu...">
				</fieldset>
			</div>
			<div class="col-6">
				<fieldset class="form-group">
					<label for="formGroupExampleInput">Giá điện</label>
					 @if($errors->has('electric'))
		                <p class="text-danger">{{$errors->first('electric')}}</p>
		            @endif
		            <input type="number" step="0.001" name="electric" value="{{$post->electric}}" class="col-10" placeholder="Giá điện bao nhiêu...">
				</fieldset>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
			<fieldset class="form-group">
				<label for="formGroupExampleInput">Giá nước</label>
				<input type="number" step="0.001" name="water" value="{{$post->water}}" class="col-10" placeholder="Giá nước bao nhiêu...">
			</fieldset>
			</div>
			<div class="col-6">
				<fieldset class="form-group">
					<label for="formGroupExampleInput">Giá <small class="text-danger">*</small></label>
					 @if($errors->has('price'))
		                <p class="text-danger">{{$errors->first('price')}}</p>
		            @endif
		            <input type="number" step="0.001" name="price" value="{{$post->price}}" class="col-10" placeholder="Giá phòng bao nhiêu...">
				</fieldset>
			</div>
		</div>
		<h4 class="text-danger mb-4">Thông Tin Liên Hệ</h4>
		<fieldset class="form-group">
			<label for="formGroupExampleInput">Người liên hệ</label>
            <input type="text" name="name" value="{{$userPost[0]}}" class="ip-rw-2" placeholder="Họ và tên">
		</fieldset>
		<fieldset class="form-group">
			<label for="formGroupExampleInput">SỐ điện thoại</label>
            <input type="text" name="phone" value="{{$userPost[0]}}" class="ip-rw-2" placeholder="Số điện thoại">
		</fieldset>
		<fieldset class="form-group">
			<label for="formGroupExampleInput">Địa chỉ</label>
            <textarea id="Field" name="address" spellcheck="true" rows="2" cols="50" tabindex="4" placeholder="Địa chỉ liên hệ...">{{$userPost[2]}}</textarea>
		</fieldset>
		<div class="row">
			<div class="col-12 text-center">
				<input type="submit" class="btn btn-success" value="Update">
			</div>
		</div>
		</div>
	</form>
</div>

@endsection
