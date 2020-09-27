@extends('layouts.master')
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
@endsection
@section('layout')
    <div class="container products v2 mt40 mb40">
        <!--Product-->
        <div class="row">
            <div class="col col-md-3 col-12 filter">
                <form id="filter" action="{{ route('filter.product') }}" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="f_ filter-cate">
                                <span class="filter-name">Chuyên mục</span>
                                <div>
                                    <label for="f-00">
                                        <input type="radio" name="cate" value="" id="f-00">
                                        <p>Tất cả</p>
                                    </label>
                                    @foreach($filter_cate as $item)
                                        <label for="f{{ $item->id }}" <?php
                                            $valueCategoryProduct = '';
                                            if(isset($_GET['cate']) && $_GET['cate'] != ''){
                                                if($_GET['cate'] == $item->id){
                                                    $valueCategoryProduct = $item->id;
                                                    echo 'class="active"';
                                                }
                                            } ?>>
                                            <input type="radio" name="cate" value="{{ $item->id }}" id="f{{ $item->id }}">
                                            <p>{{ $item->name }}</p>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="filter-price f_">
                                <span class="filter-name">Giá</span>
                                <div>
                                    <label for="price-0">
                                        <input type="radio" name="price" id="price-0" value="">
                                        <span>Tất cả</span>
                                    </label>
                                    <label for="price-1">
                                        <input type="radio" name="price" id="price-1" value="0-1000000">
                                        <span>0 - 1.000.000 <sup>₫</sup></span>
                                    </label>
                                    <label for="price-2">
                                        <input type="radio" name="price" id="price-2" value="1000000-3000000">
                                        <span>1.000.000<sup>₫</sup> - 3.000.000<sup>₫</sup></span>
                                    </label>
                                    <label for="price-3">
                                        <input type="radio" name="price" id="price-3" value="3000000-5000000">
                                        <span>3.000.000<sup>₫</sup> - 5.000.000<sup>₫</sup></span>
                                    </label>
                                    <label for="price-4">
                                        <input type="radio" name="price" id="price-4" value="5000000-10000000">
                                        <span>5.000.000<sup>₫</sup> - 10.000.000<sup>₫</sup></span>
                                    </label>
                                    <label for="price-5">
                                        <input type="radio" name="price" id="price-5" value="10000000-15000000">
                                        <span>10.000.000<sup>₫</sup> - 15.000.000<sup>₫</sup></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col col-md-9 col-12" id="filter_product">
                <div class="row filter-product--sort">
                    <div class="col col-md-6 col-12 total-product">
                        <ul class="product-selection">
                            <li id="product-selection--gird" class="selected">
                                <a href="#" title="Lưới"></a>
                            </li>
                            <li id="product-selection--list">
                                <a href="#" title="Danh sách"></a>
                            </li>
                            <p>Có {{$cate->count()}} sản phẩm</p>
                        </ul>
                    </div>
                    <div class="col col-md-6 col-12 sort-select">
                        <span>Sắp xếp theo: </span>
                        <select name="sort" onchange="filter.submit()">
                            <option value="name">mới nhất</option>
                            <option value="name">cũ nhất</option>
                            <option value="name">giá giảm dần</option>
                            <option value="name">giá tăng dần</option>
                        </select>
                    </div>
                </div>
                <div class="row response" style="margin: -12px">
                    @if (isset($cate) && count($cate) > 0)
                        @foreach ($cate as $index => $item)
                            <div class="col col-md-4 col-6">
                                <div class="item no-margin">
                                    <div class="box-thumbnail">
                                        <div class="thumbnail-lazy loaded">
                                            <img src="{{ Voyager::image($item->image) }}" alt="{{ $item->title }}">
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
                        @else
                        <div class="col-12">
                            <div id="notfound" class="text-center">
                                <img src="{{asset('public/templates/img/notfound.png')}}" alt="notfound products">
                                <div>Không tìm thấy sản phẩm phù hợp nào dành cho bạn!</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

  {{ $cate->links('vendor.pagination.default') }}
@endsection
@section('footer')
@endsection