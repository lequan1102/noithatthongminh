@extends('layouts.master')
@section('layout')
    <section class="container news">
        <!--BREADCRUMB-->
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-4 col-12 sidebar">
                <h2>Mạng xã hội</h2>
                <h2>Liên hệ</h2>
            </div>
            <div class="col col-md-8 col-12">
                @if(isset($cate))
                    @foreach($cate as $index => $item)
                        <a href="{{ route('article.news',['slug'=>$item->slug,'id'=>$item->id]) }}" class="article mirror" title="{{ $item->title }}">
                            <div class="wrapper">
                                <div class="box-thumbnail">
                                    <div class="thumbnail-lazy loaded">
                                        <img src="{{ Voyager::image($item->image) }}" alt="{{ $item->title }}">
                                    </div>
                                </div>
                            </div>
                            <div class="des">
                                <span>{{ $item->title }}</span>
                                <div class="auth">Viết bởi <b>Thiết bị thông minh</b>, {{ \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans() }}</div>
                                <p>{{ $item->excerpt }}</p>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
            {{ $cate->links('vendor.pagination.default') }}
        </div>
    </section>

@endsection
