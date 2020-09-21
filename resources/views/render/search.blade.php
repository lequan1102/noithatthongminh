
@if (isset($result_search))
    @foreach ($result_search as $item)
        <a class="item-product" href="{{ route('article.product',['slug' => $item->slug, 'id' => $item->id]) }}">
            <div class="dpl">
                <div class="item-thumbnail">
                    <img src="{{ Voyager::image($item->image) }}">
                </div>
                <span>{{$item->title}}</span>
            </div>
            <div class="item-product-price"><?php echo ($item->discount_price != null) ? $item->discount_price : $item->price ?><sup>₫</sup></div>
        </a>
    @endforeach
@endif
