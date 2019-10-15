@extends('layout.user')

@section('header')
<link rel="stylesheet" href="/css/normalize.css">
@endsection


@section('container')
	<div class="container">
        <div class="row-content">
            <div class="detail">
                <h3>Chi Tiết Phòng</h3>
                <div class="top-detail">
                    <div class="left-top-detail">
                        <div class="p-detail">
                            <p>
                                Giá:
                                <strong> <?php echo number_format($post->price) ?> đ</strong>
                            </p>
                            <p>
                                Diện Tích:
                                <strong>{{$post->area}} m<sup>2</sup></strong>
                            </p>
                            <p>
                                Địa Chỉ Nhà:
                                <strong>{{$post->address}}</strong>
                            </p>
                            <p>
                                Mã Phòng:
                                <strong>{{$post->id}}</strong>
                            </p>
                        </div>
                    </div>
                    <div class="right-top-detail">
                        <div class="p-detail">
                            <p><strong>Thông Tin Liên Hệ</strong></p>
                            <p>
                                Họ & Tên:
                                <strong><?php echo ucwords($name) ?></strong>
                            </p>
                            <p>
                                Số Điện Thoại:
                                <strong>{{$phone}}</strong>
                            </p>
                            <p>
                                Địa Chỉ:
                                <strong> <?php echo ucwords($address); ?> </strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="main-detail">
                    <div class="document-detail">
                        <h6>Chi tiết cho thuê phòng {{$post->id}}</h6>
                        <p>
                            - {{$address}}</br>
                            - Diện tích: {{$post->area}}<sup>2</sup>, sạch sẽ, mới xây, wc trong</br>
                            - Yêu cầu: 
                        </p>
                        <h5><strong>Trạng Thái: </strong><strong style="color: rgb(6, 250, 46);"><?php if($post->status==1) echo "Rảnh"; if($post->status==2) echo "Đã có người giữ";if($post->status==3) echo "Đã được thuê";  ?></strong></h5>
                    </div>
                    <div class="wrapper">
                        <div class="img-main-detail gallery-top">
                            <div class="swiper-wrapper">
                            	@if(!empty($img))
                                    <img src='{{asset("/upImage/$img")}}' class="img-fluid" style="width: 100%; height: 500px;"></img>
                                @endif
                                @if(empty($img))
									<img src='/images/Bản-vẽ-thiết-kế-phòng-trọ-đẹp-và-tiết-kiệm-chi-phí-tại-Đà-Nẵng8-1.jpg' class="img-fluid" style="width: 100%;"></img>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                    <div class="btn-detail d-flex justify-content-between mt-5">
						@if($post->status==1)
							@if($check==2) 
							<a href="{{route('post.edit',$post->id)}}" class="btn btn-primary text-center ">Giữ Phòng</a>
							@endif
							@if($check==1)
							<p class="btn btn-danger text-center ">Bạn đang giữ phòng nên không thể giữ tiếp</p>
							@endif
	                    	<a href="" class="btn btn-primary text-center ">Lưu Tin</a>
	                    	<a href="" class="btn btn-primary text-center ">Chia Sẽ</a>
	                    	<a href="" class="btn btn-primary text-center ">Báo Cáo</a>
						@endif
                    	@if($post->status==2)
							<p class="btn btn-danger text-center mx-4">Phòng Đang Được Giữ</p>
	                    	<a href="" class="btn btn-primary text-center ">Lưu Tin</a>
	                    	<a href="" class="btn btn-primary text-center ">Chia Sẽ</a>
	                    	<a href="" class="btn btn-primary text-center ">Báo Cáo</a>
						@endif
						@if($post->status==3)
							<p class="btn btn-danger text-center">Phòng Đã Được Thuê</p>
	                    	<a href="" class="btn btn-primary text-center ">Lưu Tin</a>
	                    	<a href="" class="btn btn-primary text-center ">Chia Sẽ</a>
	                    	<a href="" class="btn btn-primary text-center">Báo Cáo</a>
						@endif
                    </div>
                </div>
            </div>
            <div class="right-row-content">
                <a href="#"><h6>Xem Thêm</h6></a>
                <div class="main-right-row">
                    <h5>MỚI ĐĂNG</h5>
                    <div class="row-main-right">
                    	@foreach($postMore as $value)
                        <div class="item-row-right">
                        	<?php $image=''; foreach ($value->images as $key => $val) {
                        		$image= $val->path;
                        		break;
                        	} ?>
                            <a href="{{route('detail',$value->id)}}">
                            	@if(!empty($image))
                            	<img src='{{asset("/upImage/$image")}}' class="img-fluid" style="width: 200px; height: 80px;" ></a>
                            	@endif
                            	@if(empty($image))
                            	<img src='/images/download.jpg' class="img-fluid" style="width: 200px; height: 80px;"></a>
                            	@endif
                            <a href="{{route('detail',$value->id)}}">
                                <p>{{$value->title}}, diện tích {{$value->area}}m<sup>2</sup>, full nội thất, giá <?php echo number_format($value->price) ?> triệu</p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection