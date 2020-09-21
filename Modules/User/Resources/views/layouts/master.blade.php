<!DOCTYPE html>
<html lang="{{ app()->getlocale() }}">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="http://voyager_shop.vtc/admin/voyager-assets?path=images%2Flogo-icon.png"/>
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
    <link rel="stylesheet" href="{{ asset('public/templates/libs/dropify/css/dropify.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
    {!! setting('site.head')  !!}
    <style>
        body{
            background-color: #eff0f4;
        }
    </style>
</head>
<body>

<?php $currentUrl =  $_SERVER['REQUEST_URI'] ?>

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
                            <div class="preview-products" style="margin-top: 10px">
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
                                <div class="quantity" id="js_total_cart">{{ Cart::getContent()->count() }}</div>
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
    </header>
    <main>
        <div class="container user mt40 mb40">
            {{-- @if(session()->has('success'))
                {!! session()->get('success') !!}
                @elseif(session()->has('error'))
                    {!! session()->get('error') !!}
            @endif --}}
            <!--USER-->
            <div class="row">
                <div class="col col-md-2 col-12">
                    <div class="about-account">
                        <ul class="nav-container">
                            <li id="manage-my-account">
                                <a href="{{ route('manage.user') }}" <?php if(strpos($currentUrl, 'manage')) echo 'class="active"' ?>>Quản lý tài khoản</a>
                                <ul>
                                    <li><a href="{{ route('profile.user') }}" <?php if(strpos($currentUrl, 'myacount')) echo 'class="active"' ?>>Thông tin cá nhân</a></li>
                                    <li><a href="{{ route('favourite.user') }}" <?php if(strpos($currentUrl, 'favourite')) echo 'class="active"' ?>>Danh sách yêu thích</a></li>
                                    <li><a href="{{ route('location.user') }}" <?php if(strpos($currentUrl, 'address')) echo 'class="active"' ?>>Sổ địa chỉ</a></li>
                                </ul>
                            </li>
                            <li id="my-order">
                                <a href="#">Đơn hàng của tôi</a>
                                <ul>
                                    <li><a href="">Đơn hàng đổi trả</a></li>
                                    <li><a href="">Đơn hàng hủy</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col col-md-9 col-12">
                    @yield('layout')
                </div>
            </div>
        </div>
    </main>
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
                <input type="text" name="keywords" placeholder="Từ khóa..">
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
<script src="{{ asset('public/templates/libs/unpkg.js') }}"></script>
<script src="{{ asset('public/templates/libs/sweetalert/sweetaleart.js') }}"></script>
<script src="{{ asset('public/templates/bs/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/templates/bs/popper.min.js') }}"></script>
<script src="{{ asset('public/templates/libs/slick/slick.min.js') }}"></script>
<script src="{{ asset('public/templates/js/classie.js') }}"></script>
<script src="{{ asset('public/templates/js/cart.js') }}"></script>
<script src="{{ asset('public/templates/libs/dropify/js/dropify.min.js') }}"></script>

{{-- <script>
    $('#avatar-image').dropify({
        messages: {
            'default': 'Kéo và thả tệp vào đây hoặc nhấp',
            'replace': 'Kéo và thả hoặc nhấp để thay thế',
            'remove':  'Xóa',
            'error':   'Rất tiếc, đã xảy ra lỗi.'
        }
    });
</script> --}}
@yield('footer')
{!! setting('site.footer')  !!}
</body>
</html>
