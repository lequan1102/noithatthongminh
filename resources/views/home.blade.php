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
                                <div class="item-inner">
                                    <div class="inner inner-cart">
                                        <svg viewBox="0 0 576 512"><path fill="currentColor" d="M551.991 64H129.28l-8.329-44.423C118.822 8.226 108.911 0 97.362 0H12C5.373 0 0 5.373 0 12v8c0 6.627 5.373 12 12 12h78.72l69.927 372.946C150.305 416.314 144 431.42 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64 35.346 0 64-28.654 64-64 0-17.993-7.435-34.24-19.388-45.868C506.022 391.891 496.76 384 485.328 384H189.28l-12-64h331.381c11.368 0 21.177-7.976 23.496-19.105l43.331-208C578.592 77.991 567.215 64 551.991 64zM464 416c17.645 0 32 14.355 32 32s-14.355 32-32 32-32-14.355-32-32 14.355-32 32-32zm-256 0c17.645 0 32 14.355 32 32s-14.355 32-32 32-32-14.355-32-32 14.355-32 32-32zm294.156-128H171.28l-36-192h406.876l-40 192zM272 196v-8c0-6.627 5.373-12 12-12h36v-36c0-6.627 5.373-12 12-12h8c6.627 0 12 5.373 12 12v36h36c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12h-36v36c0 6.627-5.373 12-12 12h-8c-6.627 0-12-5.373-12-12v-36h-36c-6.627 0-12-5.373-12-12z"></path></svg>
                                    </div>
                                    <div class="inner inner-favorite">
                                        <svg viewBox="0 0 512 512"><path fill="currentColor" d="M462.3 62.7c-54.5-46.4-136-38.7-186.6 13.5L256 96.6l-19.7-20.3C195.5 34.1 113.2 8.7 49.7 62.7c-62.8 53.6-66.1 149.8-9.9 207.8l193.5 199.8c6.2 6.4 14.4 9.7 22.6 9.7 8.2 0 16.4-3.2 22.6-9.7L472 270.5c56.4-58 53.1-154.2-9.7-207.8zm-13.1 185.6L256.4 448.1 62.8 248.3c-38.4-39.6-46.4-115.1 7.7-161.2 54.8-46.8 119.2-12.9 142.8 11.5l42.7 44.1 42.7-44.1c23.2-24 88.2-58 142.8-11.5 54 46 46.1 121.5 7.7 161.2z"></path></svg>
                                    </div>
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
            <div class="title text-center mt20 mb20">
                <h2>Sản phẩm nổi bật</h2>
                <div class="medal">
                    <div class="sub-products">
                        <img src="{{asset('public/templates/img/Seprator.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="row response">
                @if (isset($products_future))
                    @foreach ($products_future as $item)
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
            <div class="row response">
                @if (isset($products_selling))
                    @foreach ($products_selling as $item)
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
        </section>
        <section class="brand">
            <ul id="slick-brand">
                <li><img src="{{asset('')}}"></li>
            </ul>
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
