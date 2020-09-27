<!DOCTYPE html>
<html lang="{{ app()->getlocale() }}">
<head>
    <title>{{ setting('site.title') }}<?php if(isset($article)){ echo ' | ' . $article->title; } ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if(isset($article) && ($article->title != '')){ echo $article->title; } else { echo setting('site.title') . ' - ' . setting('site.description'); }?></title>
    <link rel="icon" type="image/png" href="{{ asset('storage/app/public') }}/{{ setting('site.icon_website') }}"/>
    <!--Stylesheets - Bootstrap 4.0 -->
    <link rel="stylesheet" href="{{ asset('public/templates/bs/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/templates/stylesheets/plugin.css') }}">
    <link rel="stylesheet" href="{{ asset('public/templates/stylesheets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/templates/stylesheets/page.css') }}">
    <!--Font Awesome 5.7-->
    <link rel="stylesheet" href="{{ asset('public/templates/fa/css/all.min.css') }}">
    <!--Slick-->
    <link rel="stylesheet" href="{{ asset('public/templates/libs/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('public/templates/libs/slick/slick-theme.css') }}">
    <!--Font Google-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="{{ asset('public/templates/libs/lazyload/lazysizes.min.js') }}" async=""></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($article))
        <meta name="title" content="@if($article->seo_title != ''){{ $article->seo_title }}@endif">
        <meta name="description" content="@if($article->meta_description != ''){{ $article->meta_description }}@endif">
        <meta name="keyword" content="@if($article->meta_keywords != ''){{ $article->meta_keywords }}@endif">
    @else
        <meta name="title" content="{{ setting('site.title') }}">
        <meta name="description" content="{{ setting('site.description') }}">
        <meta name="keyword" content="{{ setting('site.keyword') }}">
    @endif
    @yield('head')
</head>
<body>

<div class="wrapper">
    <div id="h-wrapper"></div>
    <header>
        <div pc>
            <div class="container head">
                <div class="pc-logo">
                    <a href="{{ asset('') }}"><img src="{{ asset('storage/app/public') }}/{{ setting('site.logo') }}"></a>
                </div>
                <div class="wrapper-pc">
                    <div class="pc-search">
                        <form action="{{ route('filter.search.product') }}" method="get">
                            <input type="text" name="keywords" placeholder="Tìm sản phẩm bạn mong muốn..">
                            <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                        <div class="search-preview">
                            <div class="preview-title">Chuyên mục</div>
                            <div class="preview-category">
                                <label for="pvall">
                                    <input type="radio" name="category_id" value="" id="pvall">
                                    <span>tất cả</span>
                                </label>
                                @if(isset($category))
                                    @foreach($category as $item)
                                        <label for="pv{{$item->id}}">
                                            <input type="radio" name="category_id" value="{{$item->id}}" id="pv{{$item->id}}">
                                            <span>{{$item->name}}</span>
                                        </label>
                                    @endforeach
                                @endif
                            </div>
                            <div class="preview-products">
                            </div>
                        </div>
                    </div>
                    <div class="pc-user">
                        <a href="{{ route('manage.user') }}">
                            <div class="w-img">
                                <img src="{{ asset('public/templates/img/icons/profile.svg') }}">
                            </div>
                            <span>@if (Auth::guard('customer')->check()) {{ Auth::guard('customer')->user()->name }} @else Tài khoản @endif</span>
                        </a>
                        <a href="{{ route('cart') }}">
                            <div class="w-img">
                                <img src="{{ asset('public/templates/img/icons/bag.svg') }}">
                                <div id="js_total_cart">{{ Cart::getContent()->count() }}</div>
                            </div>
                            <span>Giỏ hàng</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu">
                <div class="container">
                    <nav>
                        {{ menu('Thực đơn trang chủ') }}
                    </nav>
                </div>
            </div>
        </div>
        <div mobie>
            <div class="bar" id="js_open_menumobie">
                <i class="far fa-bars"></i>
            </div>
            <a href="{{asset('')}}">
                <div class="logo-mobie">
                    <img src="{{ asset('public/templates/img/logo.png') }}">
                </div>
            </a>
            <a href="{{route('cart')}}" class="cart">
                <i class="fas fa-shopping-bag"></i>
            </a>
        </div>
        <div cart>
            <a href="{{asset('')}}"><svg viewBox="0 0 448 512"><path fill="currentColor" d="M136.97 380.485l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L60.113 273H436c6.627 0 12-5.373 12-12v-10c0-6.627-5.373-12-12-12H60.113l83.928-83.444c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0l-116.485 116c-4.686 4.686-4.686 12.284 0 16.971l116.485 116c4.686 4.686 12.284 4.686 16.97-.001z"></path></svg></a>
            <div class="cart-bg"></div>
            <div class="cart-info">
                <h1>Giỏ hàng</h1>
                <nav>
                    <a href="#" class="active">Sản phẩm</a>
                    <svg viewBox="0 0 448 512"><path fill="currentColor" d="M311.03 131.515l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887l-83.928 83.444c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l116.485-116c4.686-4.686 4.686-12.284 0-16.971L328 131.515c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg>
                    <a href="#">Địa chỉ</a>
                    <svg viewBox="0 0 448 512"><path fill="currentColor" d="M311.03 131.515l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887l-83.928 83.444c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l116.485-116c4.686-4.686 4.686-12.284 0-16.971L328 131.515c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg>
                    <a href="#">Thanh toán</a>
                </nav>
            </div>
        </div>
    </header>
    @yield('layout')
    <div class="container-fluid policies">
        <div class="container">
            <div class="row">
                <div class="col col-12 col-md-3 col-sm-6">
                    <div class="item-policies shipping">
                        <div class="item-policies-thumbnail">
                            <div class="thumbnail-image"></div>
                        </div>
                        <div class="item-policies-content-box">
                            <div class="content-box-title">CHÍNH SÁCH GIAO HÀNG</div>
                            <div class="content-box-dec">Nhận hàng và thanh toán tại nhà</div>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-md-3 col-sm-6">
                    <div class="item-policies cash">
                        <div class="item-policies-thumbnail">
                            <div class="thumbnail-image"></div>
                        </div>
                        <div class="item-policies-content-box">
                            <div class="content-box-title">THANH TOÁN TIỆN LỢI</div>
                            <div class="content-box-dec">Trả tiền mặt, CK, trả góp 0%</div>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-md-3 col-sm-6">
                    <div class="item-policies online-support">
                        <div class="item-policies-thumbnail">
                            <div class="thumbnail-image"></div>
                        </div>
                        <div class="item-policies-content-box">
                            <div class="content-box-title">HỖ TRỢ NHIỆT TÌNH</div>
                            <div class="content-box-dec">Tư vấn, giải đáp mọi thắc mắc</div>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-md-3 col-sm-6">
                    <div class="item-policies discount">
                        <div class="item-policies-thumbnail">
                            <div class="thumbnail-image"></div>
                        </div>
                        <div class="item-policies-content-box">
                            <div class="content-box-title">ĐỔI TRẢ DỄ DÀNG</div>
                            <div class="content-box-dec">Dùng thử trong vòng 3 ngày</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer style="background-image: url('{{ asset('public/templates/img/footer.png') }}');">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col col-md-3 col-sm-6 col-12">
                        <b>Nội thất thông minh</b>
                        <ul>
                            <li><a href=""><i class="fas fa-map-marker-alt"></i>{{ setting('contact.location') }}</a></li>
                            <li><a href=""><i class="fas fa-envelope"></i>{{ setting('contact.address_email') }}</a></li>
                            <li><a href=""><i class="fas fa-phone-volume"></i>{{ setting('contact.number_phone') }}</a></li>
                        </ul>
                    </div>
                    <div class="col col-md-3 col-sm-6 col-12">
                        <b>LOẠI</b>
                        {{ menu('Menu footer Loại') }}
                    </div>
                    <div class="col col-md-3 col-sm-6 col-12">
                        <b>THÔNG TIN</b>
                        {{ menu('Menu footer Thông tin') }}
                    </div>
                    <div class="col col-md-3 col-sm-6 col-12">
                        <b>LIÊN KẾT NHANH</b>
                        {{ menu('Menu footer Liên kết nhanh') }}
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--Menu Mobie-->
    <section menumobie>
        <div id="mobie-bg"></div>
        <div class="wrapper-menu">
            <div class="mb-close">
                <i class="far fa-times-circle"></i>Đóng
            </div>
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Từ khóa..">
                <button><i class="fal fa-search"></i></button>
            </form>
            <nav>
                <ul class="about-user">
                    <li><a href="{{route('favourite.user')}}"><i class="far fa-heart"></i>YÊU THÍCH</a></li>
                    <li><a href="{{route('index.user')}}"><i class="far fa-user"></i>TÀI KHOẢN</a></li>
                    <li><a href="{{route('cart')}}"><i class="far fa-shopping-bag"></i>GIỎ HÀNG</a></li>
                </ul>
                {{ menu('Thực đơn trang chủ') }}
                <ul class="social">
                    <li><a href=""><i class="fab fa-facebook"></i></a></li>
                    <li><a href=""><i class="fab fa-twitter"></i> </a></li>
                    <li><a href=""><i class="fab fa-instagram"></i></a></li>
                    <li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
                </ul>
            </nav>
        </div>
    </section>
    <a id="up" href="#up" class="show"><svg viewBox="0 0 448 512"><path fill="currentColor" d="M6.1 422.3l209.4-209.4c4.7-4.7 12.3-4.7 17 0l209.4 209.4c4.7 4.7 4.7 12.3 0 17l-19.8 19.8c-4.7 4.7-12.3 4.7-17 0L224 278.4 42.9 459.1c-4.7 4.7-12.3 4.7-17 0L6.1 439.3c-4.7-4.7-4.7-12.3 0-17zm0-143l19.8 19.8c4.7 4.7 12.3 4.7 17 0L224 118.4l181.1 180.7c4.7 4.7 12.3 4.7 17 0l19.8-19.8c4.7-4.7 4.7-12.3 0-17L232.5 52.9c-4.7-4.7-12.3-4.7-17 0L6.1 262.3c-4.7 4.7-4.7 12.3 0 17z"></path></svg></a>
</div>

<!--QUICKVIEW PRODUCT-->
<div class="wrapper-quickview pt50">
    <div class="overlay-modal"></div>
    <div class="container pt30 pb30">
        <i class="fal fa-times"></i>
        <div class="row">
        </div>
    </div>
</div>

<!--Javascript Libs-->
<script src="{{ asset('public/templates/js/jquery-3.3.1.min.js') }}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{-- <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script> --}}
<script src="{{ asset('public/templates/libs/sweetalert/sweetaleart.js') }}"></script>
<script src="{{ asset('public/templates/bs/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/templates/bs/popper.min.js') }}"></script>
<script src="{{ asset('public/templates/libs/slick/slick.min.js') }}"></script>
<script src="{{ asset('public/templates/js/classie.js') }}"></script>
<script src="{{ asset('public/templates/js/cart.js') }}"></script>

@yield('footer')
{!! setting('site.body')  !!}
</body>
</html>
