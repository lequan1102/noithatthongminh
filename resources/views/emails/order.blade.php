
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gmail</title>
    <style>
        .email-container {
            border-top: 2px solid #ececec;
            margin-top: 20px
        }
        .email-product--item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #ececec;
        }
        h2, p {
            margin: 0;
        }
        li {
            list-style: none;
            margin-left: 0px;
        }
        .clear {
            clear: both;
        }
        .product-info {
            float: left;
            width: 80%;
            margin: 15px 0px;
        }
        .product-info-image {
            width: 80px;
            float: left;
        }
        .product-info-title {
            float: left;
            margin-left: 10px;
        }
        .product-price {
            float: right;
            width: 20%;
            text-align: center;
            font-weight: 500;
            display: flex;
            padding: 23px 0;
        }
        .email-product-total {
            width: 300px;
            float: right;
        }
        .email-product-total ul li:last-child {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <h2 style="font-size: 20px">Cảm ơn bạn đã mua hàng</h2>
    <p>Xin chào Quân, Chúng tôi đã nhận được đơn đặt hàng của bạn và đã sẵn sàng để vận chuyển. Chúng tôi sẽ thông báo cho bạn khi đơn hàng đã được gửi đi</p>
    <div class="email-container">
        @if((isset($cart) && $cart->count() > 0))
            @foreach($cart as $item)
            <div class="email-product--item">
                <div class="product-info">
                    <div class="product-info-image">
                        <img style="width: 75px; border-radius: 8px; border: 1px solid #cccccc; padding:2px" src="{{Voyager::image($item->associatedModel->image)}}">
                    </div>
                    <div class="product-info-title">
                        <span style="font-weight: 500; color: #3a3a3a">{{$item->name}}</span><br>
                        Giá: <span style="font-weight: 500;"><?php echo number_format($item->price,0,'.','.') . ' x ' . $item->quantity ?></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="product-price"><?php echo number_format($item->getPriceSum(), 0,'.','.'); ?><sup>₫</sup></div>
                <div class="clear"></div>
            </div>
            @endforeach
            <div class="email-product-total">
                <ul style="display: flex;align-items:center;justify-content: space-between;padding:15px 0;border-bottom: 2px solid #ececec">
                    <li>Tổng số lượng:</li>
                    <li style="font-size: 20px;color: #ff3b00;font-weight: 500;transform: translateY(-7px)">{{ Cart::getTotalQuantity() }}</li>
                </ul>
                <ul style="display: flex;align-items:center;justify-content: space-between;padding:15px 0;border-bottom: 2px solid #ececec">
                    <li>Tổng đơn hàng:</li>
                    <li style="font-size: 20px;color: #ff3b00;font-weight: 500;transform: translateY(-7px)"><?php echo number_format(Cart::getTotal(), 0, ',', '.') ?><sup>₫</sup></li>
                </ul>
            </div>
            <div style="clear: both"></div>
        @endif
    </div>
    <div class="customer-information" style="margin-top: 40px">
        <h2 style="text-transform: uppercase;font-size: 20px;color: #383838;">Thông tin khách hàng</h2>
        <div class="ci-item">
            <span style="font-size: 15px; font-weight: 500; color: #383838">Địa chỉ giao hàng</span>
            <p style="font-size: 14px; color: #757575"><?php print_r($request['full_name']) ?> - <?php print_r($request['number_phone']) ?></p>
            <p style="font-size: 14px; color: #757575"><?php print_r($request['location']) ?>, <?php print_r($request['ward']) ?> - <?php print_r($request['district']) ?> - <?php print_r($request['province']) ?></p>
            <p><?php print_r($request['note']) ?></p>
        </div>
        <br>
        <div class="ci-item">
            <span style="font-size: 15px; font-weight: 500; color: #383838">Phương thức thanh toán</span>
            <p style="font-size: 14px; color: #757575">Thanh toán khi giao hàng (COD)</p>
        </div>
        <br>
        <div class="ci-item">
            <span style="font-size: 15px; font-weight: 500; color: #383838">Phương thức vận chuyển</span>
            <p style="font-size: 14px; color: #757575">VC</p><br>
        </div>
    </div>
</body>
</html>
