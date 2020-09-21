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
                        <div class="col-12 filter-cate">
                            <span class="filter-name">Chuyên mục</span>
                            <div>
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
                    <div class="row">
                        <div class="col-12 filter-price">
                            <span class="filter-name">Giá</span>
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
                </form>
            </div>
            <div class="col col-md-9 col-12" id="filter_product">
                <div class="row">
                    <div class="col col-sm-6 col-12">
                        <div class="filter-product--sort">
                            <span>Sắp xếp: </span>
                            <select name="sort" onchange="filter.submit()">
                                <option value="name">mới nhất</option>
                                <option value="name">cũ nhất</option>
                                <option value="name">giá giảm dần</option>
                                <option value="name">giá tăng dần</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if (isset($cate) && count($cate) > 0)
                        @foreach ($cate as $index => $item)
                            <div class="col col-md-4 col-6">
                                <div class="item no-margin">
                                    <div class="box-thumbnail">
                                        <div class="thumbnail-lazy loaded">
                                            <img src="{{ Voyager::image($item->image) }}" alt="{{ $item->title }}">
                                        </div>
                                        <div class="box-content">
                                            <button class="quickview" id="js_quickview" data-product-id="{{ $item->id }}">Xem nhanh</button>
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
                        Khoong tim thay san pham phu hop
                    @endif
                </div>
            </div>
        </div>
    </div>

  {{ $cate->links('vendor.pagination.default') }}
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
    <script>
        $(".js-range-slider").ionRangeSlider({
            onStart: function (data) {
                // Called right after range slider instance initialised
        
                // console.log(data.input);        // jQuery-link to input
                // console.log(data.slider);       // jQuery-link to range sliders container
                // console.log(data.min);          // MIN value
                // console.log(data.max);          // MAX values
                // console.log(data.from);         // FROM value
                // console.log(data.from_percent); // FROM value in percent
                // console.log(data.from_value);   // FROM index in values array (if used)
                // console.log(data.to);           // TO value
                // console.log(data.to_percent);   // TO value in percent
                // console.log(data.to_value);     // TO index in values array (if used)
                // console.log(data.min_pretty);   // MIN prettified (if used)
                // console.log(data.max_pretty);   // MAX prettified (if used)
                // console.log(data.from_pretty);  // FROM prettified (if used)
                // console.log(data.to_pretty);    // TO prettified (if used)
            },
        
            onChange: function (data) {

            },
        
            onFinish: function (data) {
                // $(this).closest('form').submit();
                console.log(data.to);
                console.log(data.from);
                $.ajax({
                    type: "get",
                    url: "{{ route('filter.product') }}",
                    data: {
                        'id': $(this).data('productid'),
                        '_token': '{{ csrf_token() }}',
                        'min_price': data.from,
                        'max_price' : data.to
                    },
                    success: function (response) {
                        $("#filter_product").html(response);
                        console.log(response.min_price);
                        console.log(response.max_price);
                    }
                });
            },
        
            onUpdate: function (data) {
                // Called then slider is changed using Update public method
        
                console.log(data.from_percent);
            }
        });
    </script>
@endsection