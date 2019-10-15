@extends('layout.user')

@section('header')
<style>
    a:hover{
        text-decoration: none;
    }
</style>
@endsection

@section('container')
<div class="container">
        <div class="top-container">
            <h1>ĐẶC ĐIỂM PHÒNG TRỌ</h1>
            <div class="menu-container text-center">
                    @foreach($district as $value)
                    <a href="{{route('searchDistrict',$value->id)}}" class="btn btn-primary">{{$value->name}}</a>
                    @endforeach
            </div>
        </div>

    <div class="row">
        @if($post->isEmpty())
        <div class="col-4"></div>
        <div class="col-8">
            <h5>Không tìm thấy sản phẩm.</h5>
        </div>
        @else
            @foreach($post as $value)
                <?php $img='';
                     foreach ($value->images as $key => $val) {
                        $img=$val->path;
                        break;
                    }?>
                <div class="col-3 mb-4 mt-4">
                    <div class="card">
                        <a href="{{route('detail',$value->id)}}">
                            <img class="card-img-top" src='{{asset("upImage/$img")}}' style="width: 100%; height: 220px;" alt="Card image cap">
                        </a>
                       <div class="card-block text-center mt-2">
                            <a href="{{route('detail',$value->id)}}">
                                <h5 class="card-title">Mã Phòng: {{$value->id}}</h5>
                                <p class="card-text"><?php echo ucwords($value->title) ?></p>
                            </a>
                       </div>
                   </div>       
                </div>

            @endforeach
        @endif
    </div>
    <div class="main-container">
        <h1>CÁC PHÒNG MỚI NHẤT</h1>
    </div>
    <div class="slider-seeroom" style="margin: 0 auto; width: 100%;">
        <div class="swiper-wrapper">
            @foreach($nearPost as $key => $value)
            <div class="swiper-slide slide-2">
                <a href="{{route('detail',$key)}}">
                    <img src='{{asset("/upImage/$value")}}'>
                </a>
            </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
@endsection