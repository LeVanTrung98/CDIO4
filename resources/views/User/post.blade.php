@extends('layout.user')

@section('header')
@endsection

@section('container')
	<div class="container post">
        <div class="container text-center" >
            <h1 class="text-danger" style="margin-top: -120px; margin-bottom: -50px;">ĐĂNG TIN CHO THUÊ PHÒNG TRỌ</h1>
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success text-center">
            {{session('success')}}
        </div>
        @endif
        <form action="{{route('post.store')}}" class="frm-post" method="post" enctype="multipart/form-data">
            @csrf
            <div class="head-name">
                <label class="desc" id="title4" for="Field4">
                    Ảnh (*):
                </label>
                <div class="ip-head">
                    @if($errors->has('images'))
                        <p class="text-danger">{{$errors->first('images')}}</p>
                    @endif
                    <input type="file" name="images">
                </div>
            </div>
            <div class="head-name">
                <label class="desc" id="title4" for="Field4">
                    Tên Tiêu Đề (*):
                </label>
                <div class="ip-head">
                    @if($errors->has('title'))
                        <p class="text-danger">{{$errors->first('title')}}</p>
                    @endif
                    <input type="text" name="title" value="{{old('title')}}" class="col-12" placeholder="Cho thuê phòng trọ, địa chỉ ở đâu...">
                </div>
            </div>
            <div class="head-name">
                <label class="desc" id="title4" for="Field4">
                    Mô Tả (*):
                </label>
                <div class="ip-head">
                    @if($errors->has('content'))
                        <p class="text-danger">{{$errors->first('content')}}</p>
                    @endif
                    <textarea id="Field4" name="content" spellcheck="true" rows="10" cols="50" tabindex="4" placeholder="Mô tả thêm thông tin, giá cả, tiện ích, quy định..."></textarea>
                </div>
            </div>
            <div class="frm-select">
                <div class="left-select">
                    <label class="desc" id="title4" for="Field4">
                        Quận/Huyện:
                    </label>
                    <div class="select-op">
                        @if($errors->has('district'))
                        <p class="text-danger">{{$errors->first('district')}}</p>
                    @endif
                        <select id="sel-option" name="district" class="sel-option">
                            <option selected="selected" value="0">QUẬN/HUYỆN</option>
                            <option value="" class="seperator" disabled="disabled">-----</option>
                            @foreach($district as $key=>$val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="right-select">
                    <label class="desc" id="title4"  for="Field4">
                        Phường:
                    </label>
                    <div class="select-op">
                        @if($errors->has('ward'))
                        <p class="text-danger">{{$errors->first('ward')}}</p>
                    @endif
                        <select id="sel-option" name="ward" class="sel-option">
                            <option selected="selected" value="0">PHƯỜNG</option>
                            <option value="" class="seperator" disabled="disabled">-----</option>
                            @foreach($ward as $key=>$val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="frm-select">
                <div class="left-select">
                    <label class="desc" id="title4" for="Field4">
                        Diện Tích(m<sup>2</sup>):
                    </label>
                    <div class="select-op">
                        @if($errors->has('area'))
                        <p class="text-danger">{{$errors->first('area')}}</p>
                    @endif
                    <input type="text" name="area" value="{{old('area')}}" class="col-10" placeholder="Diện tích phòng bao nhiêu...">
                    </div>
                </div>
                <div class="right-select">
                    <label class="desc" id="title4" for="Field4">
                        Địa Chỉ Nhà:
                    </label>
                    <div class="select-op">
                        @if($errors->has('address1'))
                            <p class="text-danger">{{$errors->first('address1')}}</p>
                        @endif
                        <input type="text" name="address1" class="col-10" value="{{old('address')}}" placeholder="Địa chỉ phòng trọ ở đâu...">
                    </div>
                </div>
            </div>
            <div class="frm-select">
                <div class="left-select">
                    <label class="desc" id="title4" for="Field4">
                        Giá(*):
                    </label>
                    <div class="select-op">
                        @if($errors->has('price'))
                            <p class="text-danger">{{$errors->first('price')}}</p>
                        @endif
                        <input type="number" step="0.001" name="price" value="{{old('price')}}" class="col-10" placeholder="Giá phòng bao nhiêu...">
                    </div>
                </div>
            </div>
            <div class="frm-select">
                <div class="left-select">
                    <label class="desc" id="title4" for="Field4">
                        Giá điện:
                    </label>
                    <div class="select-op">
                        
                        <input type="number" step="0.001" name="electric" value="{{old('electric')}}" class="col-10" placeholder="Giá điện bao nhiêu...">
                    </div>
                </div>
            </div>
            <div class="frm-select">
                <div class="left-select">
                    <label class="desc" id="title4" for="Field4">
                        Giá nước:
                    </label>
                    <div class="select-op">
                        <input type="number" step="0.001" name="water" value="{{old('water')}}" class="col-10" placeholder="Giá nước bao nhiêu...">
                    </div>
                </div>
            </div>
            <h4>THÔNG TIN LIÊN HỆ</h4>
            <div class="frm-select">
                <div class="left-select">
                    <label class="desc" id="title4" for="Field4">
                        Người Liên Hệ:
                    </label>
                    <div class="select-op">
                        <input type="text" name="name" class="ip-rw-2" placeholder="Họ và tên">
                    </div>
                </div>
                <div class="right-select">
                    <label class="desc" id="title4" for="Field4">
                        Số Điện Thoại:
                    </label>
                    <div class="select-op">
                        <input type="text" name="phone" class="ip-rw-2" placeholder="Số điện thoại">
                    </div>
                </div>
            </div>
            <div class="head-name" style="margin-top: 10px;">
                <label class="desc" id="title4" for="Field4">
                        Địa Chỉ:
                </label>
                <div class="ip-head">
                    <textarea id="Field" name="address" spellcheck="true" rows="10" cols="50" tabindex="4" placeholder="Địa chỉ liên hệ..."></textarea>
                </div>
            </div>
            <div class="btn-up">
                <input type="submit" class="btn btn-success" value="Submit">
                <!-- <button class="btn-update">CẬP NHẬT</button> -->
            </div>
        </form>
    </div>
@endsection