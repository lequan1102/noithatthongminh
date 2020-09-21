@extends('layouts.master')
@section('head')
    <link rel="stylesheet" href="{{ asset('public/templates/libs/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('public/templates/libs/slick/slick-theme.css') }}">
@endsection
@section('layout')
    <?php $images=json_decode($article->multi_image); ?>
    <div class="container product-article">
        <div class="row">
            <div class="col-12">
                <div class="breabcrumb-gr">
                    <li><a href="{{ asset('') }}">Trang chủ</a></li>
                    <li><a href="{{ route('cate.product') }}">Sản phẩm</a></li>
                    <li>{{ $article->title }}</li>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-5 col-12">
                <div class="slider-for">
                    @if(isset($images))
                        @foreach($images as $image)
                        <div class="for">
                            <img src="{{Voyager::image($image)}}">
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="slider-nav">
                    @if(isset($images))
                        @foreach($images as $image)
                        <div class="for">
                            <img src="{{Voyager::image($image)}}">
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col col-md-4 col-12 excerpt">
                <h1>{{ $article->title }}</h1>
                @if ($article->discount_price == null)
                    <span class="price">{{ $article->price }} đ</span> <br>
                    @else
                    <span class="price">{{ $article->discount_price }} đ</span> <br>
                    <span class="price_market">Giá thị trường: <u> {{$article->price}} đ</u></span>
                @endif
                <div class="product-excerpt">
                    {!! $article->excerpt !!}
                </div>
                <div class="subm-pr">
                    <div class="quantity">
                        <input type="button" onclick="decrementValue()" value="-">
                        <input type="text" name="quantity" value="@if (isset($quantityCart)) {{ $quantityCart->quantity }} @else 1 @endif" maxlength="2" max="100" size="1" id="number">
                        <input type="button" onclick="incrementValue()" value="+">
                    </div>
                    <a href="javascript:void(0)" id="js_addCart" data-product-id="{{$article->id}}" class="add-cart">Thêm giỏ hàng</a>
                    <span class="favorite" id="js_favorite" data-product-id="{{$article->id}}" title="Yêu thích">
                        @if (!Auth::guard('customer')->check() || $existsFavourite == '')
                            <svg viewBox="0 0 512 512"><path fill="currentColor" d="M458.4 64.3C400.6 15.7 311.3 23 256 79.3 200.7 23 111.4 15.6 53.6 64.3-21.6 127.6-10.6 230.8 43 285.5l175.4 178.7c10 10.2 23.4 15.9 37.6 15.9 14.3 0 27.6-5.6 37.6-15.8L469 285.6c53.5-54.7 64.7-157.9-10.6-221.3zm-23.6 187.5L259.4 430.5c-2.4 2.4-4.4 2.4-6.8 0L77.2 251.8c-36.5-37.2-43.9-107.6 7.3-150.7 38.9-32.7 98.9-27.8 136.5 10.5l35 35.7 35-35.7c37.8-38.5 97.8-43.2 136.5-10.6 51.1 43.1 43.5 113.9 7.3 150.8z"></path></svg>
                            @else
                            <svg viewBox="0 0 512 512"><path fill="currentColor" d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                        @endif
                    </span>
                </div>
            </div>
            <!--commitment-->
            <div class="col col-md-3 col-12 side-product">
                <b>Cam kết</b>
                <ul class="commitment">
                    <li>
                        <b>Chất lượng vượt chội</b>
                        <p>Đồ nội thất nhập khẩu độc quyền và sản xuất đạt tiêu chuẩn xuất Âu</p>
                    </li>
                    <li>
                        <b>GIÁ CẢ TỐT NHẤT</b>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less</p>
                    </li>
                    <li>
                        <b>Thương hiệu uy tín</b>
                        <p>Chính sách bảo hành đảm bảo tối đa quyền lợi khách hàng, sẵn sàng lắng nghe và phục vụ 24/7</p>
                    </li>
                </ul>
                <ul class="hotline">
                    <li>
                        <img src="{{ asset('public/templates/img/icons/team.png') }}">
                        <div class="hotline-des">
                            <p>36 Đa Khoa - Hữu Bằng</p>
                            <span>0916.113.133</span>
                        </div>
                    </li>
                    <li>
                        <img src="{{ asset('public/templates/img/icons/team.png') }}">
                        <div class="hotline-des">
                            <p>33 Mạc Thái Tổ</p>
                            <span>0916.113.133</span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-12 body-product mt40 mb40">
                <h4>Mô tả sản phẩm</h4>
                <div class="body-product-c">
                    {!! $article->body !!}
                </div>
            </div>
        </div>
    </div>
    @if (isset($related))
    <div class="container products v2">
        <div class="title-product v2 mt20 mb20">
            <h2>Sản phẩm liên quan</h2>
            <div class="arrow">
                <div class="ar arrow-l pr1 slick-arrow slick-disabled" aria-disabled="true" style=""><i class="far fa-angle-left"></i></div>
                <div class="ar arrow-r pr2 slick-arrow" aria-disabled="false" style=""><i class="far fa-angle-right"></i></div>
            </div>
        </div>
        <div class="products-items slick-product-relate">
        @foreach($related as $index => $item)
            <a href="{{ route('article.product',['slug' => $item->slug, 'id' => $item->id]) }}" class="item">
                <div class="box-thumbnail">
                    <div class="thumbnail-lazy loaded">
                        <img src="{{ Voyager::image($item->image) }}" alt="{{ $item->title }}" loading="lazy">
                    </div>
                </div>
                <div class="des">
                    <span>{{ $item->title }}</span>
                    <p>{{ $item->price }}</p>
                </div>
            </a>
        @endforeach
        </div>
    </div>
    @endif
@endsection
@section('footer')
    <script src="{{ asset('public/templates/libs/slick/slick.min.js') }}"></script>
    <script>
        function incrementValue(){
            var value = parseInt(document.getElementById('number').value, 10);
            value = isNaN(value) ? 0 : value;
            if(value<100){
                value++;
                document.getElementById('number').value = value;
            }
        }
        function decrementValue(){
            var value = parseInt(document.getElementById('number').value, 10);
            value = isNaN(value) ? 0 : value;
            if(value>1){
                value--;
                document.getElementById('number').value = value;
            }
        }
    </script>
    <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav',
            adaptiveHeight: true
        });
        $('.slider-nav').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            focusOnSelect: true
        });
        $('.slick-product-relate').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            prevArrow: '.ar.pr1',
            nextArrow: '.ar.pr2',
            responsive: [
                {
                    breakpoint: 540,
                    settings: {
                    slidesToShow: 2
                    }
                },
            ]
        });
    </script>
@endsection