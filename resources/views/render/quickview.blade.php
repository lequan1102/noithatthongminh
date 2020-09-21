<div class="col col-lg-8 col-12 clear">
    <div class="quickview-nav">
        <div class="slider-nav-quickview">
            <?php $images = json_decode($product->multi_image); ?>
            @if(isset($images))
                @foreach($images as $image)
                    <div class="item">
                        <img src="{{Voyager::image($image)}}">
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="quickview-for">
        <div class="arrows-quickview-for">
            <button class="arrows-quickview-for-left"><i class="fal fa-chevron-left"></i></button>
            <button class="arrows-quickview-for-right"><i class="fal fa-chevron-right"></i></button>
        </div>
        <div class="slider-for-quickview">
            <?php $images = json_decode($product->multi_image); ?>
            @if(isset($images))
                @foreach($images as $image)
                    <div class="item">
                        <img src="{{Voyager::image($image)}}">
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<div class="col col-lg-4 col-12 content">
    <a href="{{ route('article.product',['slug'=>$product->slug,'id'=>$product->id]) }}">{{ $product->title }}</a>
    <div class="ex">
        {{ $product->excerpt }}
    </div>
    @if($product->discount_price != '')
        <div class="discount-price">{{ $product->discount_price }} đ</div>
        <div class="price">{{ $product->price }} đ</div>
        @elseif($product->price == '')
            <div class="discount-price">Liên hệ</div>
        @else
            <div class="discount-price">{{ $product->price }} đ</div>
    @endif
    <div class="flex alignC justBW mt20">
        <div class="quantity">
            <input type="button" onclick="decrementValue()" value="-">
            <input type="text" name="quantity" value="@if (isset($cart)) {{ $cart[$product->id]['quantity'] }} @else 1 @endif" maxlength="2" max="100" size="1" id="number">
            <input type="button" onclick="incrementValue()" value="+">
        </div>
        <button class="addcart" id="js_addCart" data-product-id="{{ $product->id }}">Thêm giỏ hàng</button>
    </div>
    <nav class="social mt20">
        <a href=""><i class="fab fa-facebook"></i></a>
        <a href=""><i class="fab fa-twitter"></i></a>
        <a href=""><i class="fab fa-instagram"></i></a>
        <a href=""><i class="fab fa-linkedin-in"></i></a>
    </nav>
</div>
<script>
    function incrementValue(){
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        if(value<100){
            value++;
            document.getElementById('number').value = value;
        }
    }
    function decrementValue(){
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        if(value>1){
            value--;
            document.getElementById('number').value = value;
        }
    }
    $('.slider-for-quickview').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        asNavFor: '.slider-nav-quickview',
        lazyLoad: 'ondemand',
        prevArrow: '.arrows-quickview-for-left',
        nextArrow: '.arrows-quickview-for-right'
    });
    $('.slider-nav-quickview').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for-quickview',
        vertical: true,
        centerMode: true,
        focusOnSelect: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 540,
                settings: {
                    slidesToShow: 3
                }
            }
        ]

    });
</script>
