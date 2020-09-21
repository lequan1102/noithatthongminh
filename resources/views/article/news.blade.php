@extends('layouts.master')
@section('layout')
    <section class="container news">
        <!--BREADCRUMB-->
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="/tin-tuc"></a>Tin tức</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row" style="padding: 0 15px">
            <div class="col col-md-3 col-12 sidebar">
                <h2>Bài viết liên quan</h2>
                @if(isset($related))
                    @foreach($related as $item)
                        <a href="{{ route('article.news',['slug'=>$item->slug,'id'=>$item->id]) }}" class="s-item clear">
                            <div class="thumbnail">
                                <img src="{{ Voyager::image($item->image)  }}" alt="">
                            </div>
                            <span>{{ $item->title }}</span>
                        </a>
                    @endforeach
                @endif
            </div>
            <div class="col col-md-9 col-12">
                <h1>{{ $article->title }}</h1>
                <p>Viết bởi <b>Thiết bị thông minh</b>, Ngày {{ $article->created_at }}</p>
                {!! $article->body !!}
            </div>
        </div>
    </section>
@endsection
