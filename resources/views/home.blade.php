@extends('layouts.master')
@section('layout')
    <main>
        <!--BANNER-->
        <section class="slick-banner">
            @if (isset($banner))
                @foreach ($banner as $item)
                    <div class="item" style="outline: none">
                        <img style="width: 100%" src="{{ asset('storage/app/public') }}/{{ $item->background }}" alt="{!! $item->name !!}">
                    </div>
                @endforeach
            @endif
        </section>
        <!--PRODUCTS CATEGORIES-->
        <section class="container products-category mb40">
            <div class="title text-center mt20 mb20">
                <h2>Chuyên mục sản phẩm</h2>
                <div class="medal">
                    <div class="sub-products">
                        <img src="{{asset('public/templates/img/Seprator.png')}}" alt="">
                    </div>
                </div>
            </div>
            <!--slick-category-products-->
            <div class="slick-category-products category-products">
                @if (isset($category))
                    @foreach ($category as $index => $item)
                        @if($loop->iteration % 2 != 0)
                            @if($loop->iteration != 1)
                                </div>
                            @endif
                            <div class="item">
                        @endif
                        <a href="{{ route('cate',['slug' => $item->slug]) }}" class="products-category--item">
                            <img src="{{ Voyager::image($item->icon) }}">
                            <span>{{ $item->name }}</span>
                        </a>
                    @endforeach
                @endif
            </div>
        </section>
        <!--LATEST PRODUCT-->
        <section class="container products">
            <div class="title text-center mt20 mb20">
                <h2>Sản phẩm mới nhất</h2>
                <div class="medal">
                    <div class="sub-products">
                        <img src="{{asset('public/templates/img/Seprator.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="row response">
                @if (isset($products))
                @foreach ($products as $item)
                    <div class="col col-6 col-sm-3">
                        <div class="item" style="margin: 0 0 25px 0">
                            <div class="box-thumbnail">
                                <div class="thumbnail-lazy loaded">
                                    <img alt="{{ $item->title }}" data-src="{{ Voyager::image($item->image) }}" class="lazyload">
                                </div>
                            </div>
                            <a href="{{ route('article.product',['slug' => $item->slug, 'id' => $item->id]) }}">{{ $item->title }}</a>
                            <div class="flex">
                                @if ($item->discount_price != '')
                                    <div class="discount-price">
                                        {{ $item->discount_price }} <sup>₫</sup>
                                    </div>
                                    <div class="price">
                                        {{ $item->price }} <sup>₫</sup>
                                    </div>
                                @elseif($item->discount_price == '')
                                    <div class="discount-price">
                                        {{ $item->price }} <sup>₫</sup>
                                    </div>
                                @else
                                    <div class="discount-price">
                                        Liên hệ
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>
            {{-- <div class="slick-product-1"> --}}
                
            {{-- </div> --}}
        </section>
        <!--SERVICES-->
        <section class="container services mt20 mb20">
            {!! setting('giao-dien.attention') !!}
        </section>
        <!--FEATURED PRODUCTS-->
        <section class="container products">
            <div class="title-product mt20 mb20">
                <h2>Sản phẩm nổi bật</h2>
                <div class="arrow">
                    <div class="ar arrow-l p3"><i class="far fa-angle-left"></i></div>
                    <div class="ar arrow-r p4"><i class="far fa-angle-right"></i></div>
                </div>
            </div>
            <div class="slick-product-2">
                @if (isset($products_future))
                    @foreach ($products_future as $item)
                        <div class="item">
                            <div class="box-thumbnail">
                                <div class="thumbnail-lazy loaded">
                                    <img alt="{{ $item->title }}" data-src="{{ Voyager::image($item->image) }}" class="lazyload">
                                </div>
                                <div class="box-content">
                                    <button class="quickview" onclick="quick_view(this)" data-product-id="{{ $item->id }}">Xem nhanh</button>
                                </div>
                            </div>
                            <a href="{{ route('article.product',['slug' => $item->slug, 'id' => $item->id]) }}">{{ $item->title }}</a>
                            <div class="flex">
                                @if ($item->discount_price != '')
                                    <div class="discount-price">
                                        {{ $item->discount_price }} đ
                                    </div>
                                    <div class="price">
                                        {{ $item->price }} đ
                                    </div>
                                @elseif($item->discount_price == '')
                                    <div class="discount-price">
                                        {{ $item->price }} đ
                                    </div>
                                @else
                                    <div class="discount-price">
                                        Liên hệ
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
        <!--SELLING PRODUCT-->
        <section class="container products">
            <div class="title-product mt20 mb20">
                <h2>Sản phẩm bán chạy</h2>
                <div class="arrow">
                    <div class="ar arrow-l p5"><i class="far fa-angle-left"></i></div>
                    <div class="ar arrow-r p6"><i class="far fa-angle-right"></i></div>
                </div>
            </div>
            <div class="slick-product-3">

            </div>
        </section>
        <section class="brand">
            <ul id="slick-brand">
                <li><img src="{{asset('')}}"></li>
            </ul>
        </section>
        <!--NEWS-->
        <section class="container news mt50">
            <div class="title text-center mt20 mb20">
                <h2>Các Bài viết được biên tập</h2>
                <div class="medal">
                    <div class="sub-products">
                        <img src="{{asset('public/templates/img/Seprator.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="slick-news">
                @if (isset($news))
                    @foreach ($news as $item)
                        <a href="{{ route('article.news',['slug' => $item->slug,'id' => $item->id]) }}" class="item">
                            <div class="box-thumbnail mirror">
                                <div class="thumbnail-lazy loaded">
                                    <img  data-src="{{ Voyager::image($item->image) }}" class="lazyload" alt="{{ $item->image }}">
                                </div>
                            </div>
                            <div class="des">
                                <div class="date">04/09/2020</div>
                                <span>{{ $item->title }}</span>
                                <div class="excerpt">{{ $item->excerpt }}</div>
                                <div class="more">
                                    Xem thêm
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
            <div class="arrows-news">
                <div class="arrow arrow-previous"><i class="far fa-angle-left"></i></div>
                <div class="arrow arrow-next"><i class="far fa-angle-right"></i></div>
            </div>
        </section>
        <!--TALK ABOUT US-->
        <section class="container-fluid talkaboutus pt30 pb30">
            <div class="container text-center">
                <div class="talkaboutus-arrow left"><i class="far fa-angle-left"></i></div>
                <div class="talkaboutus-arrow right"><i class="far fa-angle-right"></i></div>
                <h2>Khách hàng nói gì về chúng tôi</h2>
                <div class="slick-talkaboutus">
                    @if (isset($talkaboutus))
                        @foreach ($talkaboutus as $item)
                            <div class="item">
                                <div class="talk-avatar"><img  data-src="{{ Voyager::image($item->image) }}" class="lazyload"></div>
                                <div class="talk-excerpt">{{ $item->excerpt }}</div>
                                <div class="talk-quote"><img src="{{ asset('public/templates/img/quote.png') }}"></div>
                                <div class="talk-name">{{ $item->user }}</div>
                                <div class="talk-job">{{ $item->userex }}</div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <!--CONTACT-->
        <section class="container contact">
            <div class="row">
                <div class="col col-md-6 col-12">
                    <div class="contact-ex">
                        {!! setting('giao-dien.contact') !!}
                    </div>
                </div>
                <div class="col col-md-6 col-12">
                    <form action="" method="POST">
                        <input type="text" name="full_name" placeholder="Họ và tên">
                        <input type="text" name="number_phone" placeholder="Số điện thoại">
                        <textarea type="text" name="messages" placeholder="Lời nhắn"></textarea>
                        <button type="submit">Gửi lời nhắn ngay</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('footer')
    
@endsection
