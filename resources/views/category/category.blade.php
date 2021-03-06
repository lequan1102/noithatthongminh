@extends('layouts.master')
@section('layout')
    <div class="bg-category" style="background-image: url('{{asset('public/templates/img/benefits-of-smart-furniture.jpg')}}');">
        <div></div>
        <h1>{{$category_title->name}}</h1>
        <ol class="breadcrumb c">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chuyên mục</li>
            <li class="breadcrumb-item active" aria-current="page">{{$category_title->name}}</li>
        </ol>
    </div>
    <section class="container products">
        <!--BREADCRUMB-->
        <div class="row breadcrumb-mobie">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb v2" style="margin-bottom: 0px">
                        <li class="breadcrumb-item"><a href="{{asset('')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chuyên mục</li>
                        <li class="breadcrumb-item active" aria-current="page">{{$category_title->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        @if (isset($cate) && $cate->count()>0)
        <div class="row response">
            @foreach ($cate as $item)
                <div class="col col-6 col-sm-3">
                    <div class="item" style="margin: 0 0 25px 0">
                        <div class="box-thumbnail">
                            <div class="thumbnail-lazy loaded">
                                <img alt="{{ $item->title }}" data-src="{{ Voyager::image($item->image) }}" class="lazyload">
                            </div>
                            <div class="item-inner">
                                <div class="inner inner-cart" onclick="add_cart(this)" data-product-id="{{$item->id}}">
                                    <svg viewBox="0 0 576 512"><path fill="currentColor" d="M551.991 64H129.28l-8.329-44.423C118.822 8.226 108.911 0 97.362 0H12C5.373 0 0 5.373 0 12v8c0 6.627 5.373 12 12 12h78.72l69.927 372.946C150.305 416.314 144 431.42 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64 35.346 0 64-28.654 64-64 0-17.993-7.435-34.24-19.388-45.868C506.022 391.891 496.76 384 485.328 384H189.28l-12-64h331.381c11.368 0 21.177-7.976 23.496-19.105l43.331-208C578.592 77.991 567.215 64 551.991 64zM464 416c17.645 0 32 14.355 32 32s-14.355 32-32 32-32-14.355-32-32 14.355-32 32-32zm-256 0c17.645 0 32 14.355 32 32s-14.355 32-32 32-32-14.355-32-32 14.355-32 32-32zm294.156-128H171.28l-36-192h406.876l-40 192zM272 196v-8c0-6.627 5.373-12 12-12h36v-36c0-6.627 5.373-12 12-12h8c6.627 0 12 5.373 12 12v36h36c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12h-36v36c0 6.627-5.373 12-12 12h-8c-6.627 0-12-5.373-12-12v-36h-36c-6.627 0-12-5.373-12-12z"></path></svg>
                                </div>
                                <div class="inner inner-favorite" onclick="add_favorite(this)" data-product-id="{{$item->id}}">
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
            {{ $cate->links('vendor.pagination.simple-default') }}
        </div>
        @else
            <div id="empty-cart" class="flex alignC directionC">
                <h2>Xin lỗi!  Nội dung bạn đang tìm kiếm hiện tại chưa được cập nhật</h2>
                <span>Chúng tôi đang cố gắng cập nhật các sản phẩm tốt nhất ở đây, hãy kiên nhẫn.</span>
                <a href="{{ asset('') }}">Nhấn vào đây để tiếp tục mua sắm</a>
            </div>
        @endif
    </section>
@endsection
