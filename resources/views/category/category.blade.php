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
