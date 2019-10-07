@extends('layout.user')

@section('header')
@endsection

@section('container')
<div class="container">
        <div class="top-container">
            <h1>ĐẶC ĐIỂM PHÒNG TRỌ</h1>
            <div class="menu-container">
                <form class="form-inline my-2 my-lg-0 menu-cont">
                    <button class="btn-place" type="submit">Tất Cả</button>
                    <button class="btn-place" type="submit">Liên Chiểu</button>
                    <button class="btn-place" type="submit">Hải Châu</button>
                    <button class="btn-place" type="submit">Cẩm Lệ</button>
                    <button class="btn-place" type="submit">Hòa Vang</button>
                    <button class="btn-place" type="submit">Thanh Khê</button>
                    <button class="btn-place" type="submit">Sơn Trà</button>
                    <button class="btn-place" type="submit">Ngũ Hành Sơn</button>
                </form>
            </div>
        </div>
        <div class="row-content">
            @foreach($post as $value)
                <?php $img='';
                 foreach ($value->images as $key => $val) {
                    $img=$val->path;
                    break;
                }?>
                <div class="row-item">
                    <div class="images-item">
                        <a href="{{route('detail',$value->id)}}"><img src='{{asset("/upImage/$img")}}'></a>
                    </div>
                    <a href="{{route('detail',$value->id)}}">
                        <h6>Mã Phòng:{{$value->id}}</h6>
                        <p> <?php echo ucwords($value->title);?></p>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="main-container">
            <h1>CÁC PHÒNG XEM NHIỀU</h1>
        </div>
        <div class="slider-seeroom" style="margin: 0 auto; width: 100%;">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide-2">
                    <a href="./chitietphong.html">
                        <img src="./images/Bản-vẽ-thiết-kế-phòng-trọ-đẹp-và-tiết-kiệm-chi-phí-tại-Đà-Nẵng8-1.jpg">
                    </a>
                </div>
                <div class="swiper-slide slide-2">
                    <a href="./chitietphong.html">
                        <img src="./images/download.jpg">
                    </a>
                </div>
                <div class="swiper-slide slide-2">
                    <a href="./chitietphong.html">
                        <img src="./images/Bản-vẽ-thiết-kế-phòng-trọ-đẹp-và-tiết-kiệm-chi-phí-tại-Đà-Nẵng8-1.jpg">
                    </a>
                </div>
                <div class="swiper-slide slide-2">
                    <a href="./chitietphong.html">
                        <img src="./images/download.jpg">
                    </a>
                </div>
                <div class="swiper-slide slide-2">
                    <a href="./chitietphong.html">
                        <img src="./images/Bản-vẽ-thiết-kế-phòng-trọ-đẹp-và-tiết-kiệm-chi-phí-tại-Đà-Nẵng8-1.jpg">
                    </a>
                </div>
                <div class="swiper-slide slide-2">
                    <a href="./chitietphong.html">
                        <img src="./images/download.jpg">
                    </a>
                </div>
                <div class="swiper-slide slide-2">
                    <a href="./chitietphong.html">
                        <img src="./images/Bản-vẽ-thiết-kế-phòng-trọ-đẹp-và-tiết-kiệm-chi-phí-tại-Đà-Nẵng8-1.jpg">
                    </a>
                </div>
                <div class="swiper-slide slide-2">
                    <a href="./chitietphong.html">
                        <img src="./images/download.jpg">
                    </a>
                </div>
                <div class="swiper-slide slide-2">
                    <a href="./chitietphong.html">
                        <img src="./images/Bản-vẽ-thiết-kế-phòng-trọ-đẹp-và-tiết-kiệm-chi-phí-tại-Đà-Nẵng8-1.jpg">
                    </a>
                </div>
                <div class="swiper-slide slide-2">
                    <a href="./chitietphong.html">
                        <img src="./images/download.jpg">
                    </a>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>       
    </div>
@endsection