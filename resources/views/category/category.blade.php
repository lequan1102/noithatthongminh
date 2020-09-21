@extends('layouts.master')
@section('layout')
    <div class="bg-category" style="background-image: url('{{asset('public/templates/img/benefits-of-smart-furniture.jpg')}}');height: 200px;object-fit: cover;background-size: 100%;position: relative; margin-bottom: 30px">
        <div style="background-color: #3e3e3e9c;height: 200px;"></div>
        <h1 style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);color: #fff;text-transform: uppercase;font-size: 35px;">{{$category_title->name}}</h1>
        <ol class="breadcrumb c" style="margin-bottom: 0px;position: absolute;top: 71%;left: 50%;transform: translate(-50%,-50%);">
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
        <div class="row">
            @if(isset($cate))
                @foreach($cate as $index => $item)
                <div class="col col-6 col-md-3" style="padding: 0; margin-bottom: 20px">
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
                </div>
                @endforeach
            @endif
            {{ $cate->links('vendor.pagination.simple-default') }}
        </div>
    </section>

@endsection
