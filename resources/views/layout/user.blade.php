<!DOCTYPE html>
<html>
<head>
    <title>Quan Li Phong Tro Da Nang</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/swiper.css">
    <link rel="stylesheet" href="/css/swiper.min.css">
    <link href="/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script type="text/javascript" src="/js/swiper.js"></script>
    <script type="text/javascript" src="/js/swiper.min.js"></script>
    <script type="text/javascript" src="/js/test.js"></script>

   <!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->

    @yield('header')
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="{{route('home')}}">RENTROOM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">THUÊ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('post.index')}}">ĐĂNG TIN</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" href="#">QUẢNG CÁO</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>

                    @if(\Auth::check())
                    <a href="{{route('logout')}}" class="btn btn-info">Logout</a>
                    <a class="btn btn-info"><?php $user = \Auth::user(); echo $user->name; ?></a>
                    @endif
                    @if(!\Auth::check())
                    <a href="{{route('formLogin')}}" class="btn btn-info">Đăng Nhập</a>
                    
                    <a href="{{route('user.index')}}" class="btn btn-info">Đăng Ký</a>
                    @endif
                    
                    <!-- <button class="btn btn-primary sigin" type="button" data-toggle="modal" data-target="#myModal2">Đăng ký</button> -->
                </form>
            </div>
        </nav>
        <div class="top">
            <div class="top-text"><strong>CHÀO MỪNG BẠN ĐẾN VỚI PHÒNG TRỌ ĐÀ NẴNG</strong></div>
            <div class="top-content">
                <div class="top-left">
                    <div class="searchbox">
                        <div class="row">
                            <div class="col-lg">
                                TÌM NGAY
                            </div>
                            <div class="col-lg-12">
                                <select id="SearchContent_ctl00_ddlCategory" class="btn btn-light col-xs-12 ddl-category valid">
                                    <option selected="selected" value="0">QUẬN/HUYỆN</option>
                                    <option value="" class="seperator" disabled="disabled">-----</option>
                                    <option value="3513">CẨM LỆ</option>
                                    <option value="3514">HẢI CHÂU</option>
                                    <option value="3515">HÒA VANG</option>
                                    <option value="3516">LIÊN CHIỂU</option>
                                    <option value="3516">NGỦ HÀNH SƠN</option>
                                    <option value="3516">SƠN TRÀ</option>
                                    <option value="3516">THANH KHÊ</option>            
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <select id="SearchContent_ctl00_ddlCategory" class="btn btn-light col-xs-12 ddl-category valid">
                                    <option selected="selected" value="0">SỐ NGƯỜI</option>
                                    <option value="" class="seperator" disabled="disabled">-----</option>
                                    <option value="3513">1</option>
                                    <option value="3514">2</option>
                                    <option value="3515">3</option>
                                    <option value="3516">4</option>
                                    <option value="3516">5</option>
                                    <option value="3516">HỘ GIA ĐÌNH</option>           
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <select id="SearchContent_ctl00_ddlCategory" class="btn btn-light col-xs-12 ddl-category valid">
                                    <option selected="selected" value="0">TỐI THIỂU $</option>
                                    <option value="" class="seperator" disabled="disabled">-----</option>
                                    <option value="3513">0</option>
                                    <option value="3513">500.000</option>
                                    <option value="3514">1 TRIỆU</option>
                                    <option value="3515">2 TRIỆU</option>
                                    <option value="3516">3 TRIỆU</option>
                                    <option value="3516">4 TRIỆU</option>
                                    <option value="3516">5 TRIỆU</option>            
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <select id="SearchContent_ctl00_ddlCategory" class="btn btn-light col-xs-12 ddl-category valid">
                                    <option selected="selected" value="0">TỐI ĐA $</option>
                                    <option value="" class="seperator" disabled="disabled">-----</option>
                                    <option value="3513">1 TRIỆU</option>
                                    <option value="3514">3 TRIỆU</option>
                                    <option value="3515">6 TRIỆU</option>
                                    <option value="3516">8 TRIỆU</option>
                                    <option value="3516">10 TRIỆU</option>
                                    <option value="3516">15 TRIỆU</option>
                                    <option value="3516">> 15 TRIỆU</option>            
                                </select>
                            </div>
                            <div class="col-lg-seach">
                                <button class="btn-seach" type="submit">Tìm Kiếm</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top-right">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="/images/khach-san-view-cau-rong-song-han-gia-re-da-nang-800x533.jpg"></img>
                            </div>
                            <div class="swiper-slide">
                                <img src="/images/toa_hanh_chinh.jpg"></img>
                            </div>
                            <div class="swiper-slide">
                                <img src="/images/Ngam-cay-cau-vuot-nga-ba-hue-mytour-1.webp"></img>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top-pr">

                </div>
            </div>
        </div>
    </header>
    @yield('container')
    <footer>
        <div class="left-footer">
            <h3>Kênh Thông Tin Phòng Trọ Đà Nẵng</h3>
            <h6>( Hotline: 0396 440 443 )</h6>
            <h6>Email: rentroomdanang@gmail.com</h6>
        </div>
        <div class="right-footer">
            
        </div>
    </footer>
    <script type="text/javascript" src="./js/test.js"></script>
</body>
</html>