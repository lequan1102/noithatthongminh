@extends('layouts.master')
@section('head')
    
@endsection
@section('layout')
    <div class="container products">
        
        @if (isset($result_product))
            @foreach ($result_product as $item)
                <div class="item">
                    <div class="box-thumbnail">
                        <div class="thumbnail-lazy loaded">
                            <img src="{{ Voyager::image($item->image) }}" alt="{{ $item->title }}">
                        </div>
                        <div class="box-content">
                            <button class="quickview" data-productid="{{ $item->id }}">Xem nhanh</button>
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
    
@endsection
@section('footer')
    
@endsection