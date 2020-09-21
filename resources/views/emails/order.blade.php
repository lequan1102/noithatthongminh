<h2 style="font-size: 20px">Cảm ơn bạn đã mua hàng</h2>
<p>Xin chào Quân, Chúng tôi đã nhận được đơn đặt hàng của bạn và đã sẵn sàng để vận chuyển. Chúng tôi sẽ thông báo cho bạn khi đơn hàng đã được gửi đi</p>
<div style="border-top: 2px solid #ececec; margin-top: 20px">
    @if((isset($cart) && $cart->count() > 0))
        @foreach($cart as $item)
        <div style="display: flex;align-items: center;justify-content: space-between;border-bottom: 2px solid #ececec;">
            <div style="display: flex; align-items: center;margin: 15px 0px;">
                <div>
                    <img style="width: 75px; border-radius: 8px; border: 1px solid #cccccc; padding:2px" src="{{Voyager::image($item->associatedModel->image)}}">
                </div>
                <div style="margin-left: 10px">
                    <span style="font-weight: 500; color: #3a3a3a">{{$item->name}}</span><br>
                    Giá: <span style="font-weight: 500;"><?php echo number_format($item->price,0,'.','.') . ' x ' . $item->quantity ?></span>
                </div>
            </div>
            <div style="width: 150px;;font-weight: 500;">
                <?php echo number_format($item->getPriceSum(), 0,'.','.'); ?><sup>₫</sup>
            </div>
        </div>
        @endforeach
        <div style="float: right; width: 300px">
            <ul style="display: flex;align-items:center;justify-content: space-between;padding:15px 0;border-bottom: 2px solid #ececec">
                <li>Tổng số lượng:</li>
                <li style="font-size: 20px;color: #ff3b00;font-weight: 500">{{ Cart::getTotalQuantity() }}</li>
            </ul>
            <ul style="display: flex;align-items:center;justify-content: space-between;padding:15px 0;border-bottom: 2px solid #ececec">
                <li>Tổng đơn hàng:</li>
                <li style="font-size: 20px;color: #ff3b00;font-weight: 500"><?php echo number_format(Cart::getTotal(), 0, ',', '.') ?><sup>₫</sup></li>
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
