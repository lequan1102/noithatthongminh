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
            </div>
        @endforeach
        @else
        Không tìm thấy sản phẩm phù hợp
    @endif
    {{ $cate->links('vendor.pagination.default') }}
</div>