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
            <div class="col col-md-8 col-12">
                <h1 style="font-size: 30px">{{ $article->title }}</h1>
                <p>Viết bởi <b>Thiết bị thông minh</b>, Ngày {{ $article->created_at }}</p>
                {!! $article->body !!}
            </div>
            <div class="col col-md-4 col-12 sidebar">
                
            </div>
        </div>
        <div class="related_articles mb30 mt30">
            <h3>Bài viết liên quan</h3>
            <div class="row">
                @if(isset($related))
                    @foreach($related as $item)
                        <div class="col col-md-3 col-xs-6 col-12">
                            <article>
                                <a href="{{ route('article.news',['slug'=>$item->slug,'id'=>$item->id]) }}" class="s-item clear">
                                    <div class="thumbnail">
                                        <img src="{{ Voyager::image($item->image)  }}" alt="">
                                    </div>
                                    <span>{{ $item->title }}</span>
                                </a>
                            </article>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
