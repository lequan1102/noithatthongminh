@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="{{ asset('public/templates/libs/select2/select2.min.css') }}">
    <style>
        @media screen and (max-width: 540px) {
            a#up{
                display: none;
            }
            footer, .policies, .total {
                display: none;
            }
            
            [mobie] {
                display: none
            }
            [cart] {
                display: block
            }
            .cart {
                margin-top: 73px;
            }
        }
    </style>
@endsection
@section('layout')
    <div class="container cart mt40 mb40">
        {{-- <h2 style="font-size: 23px;font-weight: 300;">Giỏ hàng của bạn</h2> --}}
        <!--Cart-->
        <div class="row" id="js-table-cart">
            {{--Điều kiện xuất giỏ hàng khi người dùng đã đăng nhập và chưa đăng nhập--}}
            @if((isset($cart) && $cart->count() > 0))
                <div class="col col-md-8 col-12" cartPC>
                    <table>
                        <thead>
                        <th>Sản phẩm</th>
                        <th></th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        </thead>
                        <tbody class="cart-items">
                            @foreach($cart as $item)
                                <tr class="cart-row">
                                    <td class="pr flex alignC">
                                        <div class="thumbnail">
                                            <img src="{{ asset('storage/app/public') }}/{{ $item->associatedModel->image }}">
                                            <a href="{{ route('remove.cart', ['id' => $item->associatedModel->id]) }}" onclick="remove_cart()" class="bg" title="Xóa sản phẩm khỏi giỏ hàng"><i class="far fa-times-circle"></i></a>
                                        </div>
                                    </td>
                                    <td><a href="{{ route('article.product',['slug'=>$item->associatedModel->slug,'id'=>$item->id]) }}">{{ $item->name }}</a></td>
                                    <td>
                                    @if($item->associatedModel->discount_price == null)
                                        <span class="cart-price" style="color: #e7654b;font-weight: 500;">{{ $item->associatedModel->price }} <sup>₫</sup></span><br>
                                        @else
                                            <span class="cart-price" style="color: #e7654b;font-weight: 500;">{{ $item->associatedModel->discount_price }}</span><span style="color: #e7654b"><sup>₫</sup></span><br>
                                            <span style="text-decoration: line-through;color: #adadad;font-size: 15px;">{{ $item->associatedModel->price }}</span><span  style="color: #adadad"><sup>₫</sup></span>
                                    @endif
                                    </td>
                                    <td>
                                        <div class="quantity" data-productId="{{$item->associatedModel->id}}">
                                            <input type="button" onclick="decrementValue{{ $item->associatedModel->id }}(this)" value="-">
                                            <input class="cart-quantity-input" name="quantity" value="{{ $item->quantity }}" maxlength="2" max="100" size="1"  data-productid="{{ $item->associatedModel->id }}" id="number{{ $item->associatedModel->id }}">
                                            <input type="button" onclick="incrementValue{{ $item->associatedModel->id }}(this)" value="+">
                                        </div>
                                    <td>
                                        <span class="cart-price-item"><?php echo number_format($item->getPriceSum(), 0,'.','.'); ?></span> <sup>₫</sup>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{asset('')}}" class="continue_shopping"><svg viewBox="0 0 256 512"><path fill="currentColor" d="M231.293 473.899l19.799-19.799c4.686-4.686 4.686-12.284 0-16.971L70.393 256 251.092 74.87c4.686-4.686 4.686-12.284 0-16.971L231.293 38.1c-4.686-4.686-12.284-4.686-16.971 0L4.908 247.515c-4.686 4.686-4.686 12.284 0 16.971L214.322 473.9c4.687 4.686 12.285 4.686 16.971-.001z"></path></svg>Tiếp tục mua sắm</a>
                </div>
                <div class="col-12" cartMB id="cart-mobie">
                    @foreach($cart as $item)
                        <div class="cart-mobie-item">
                            <a href="{{ route('remove.cart', ['id' => $item->associatedModel->id]) }}" onclick="remove_cart()" class="button-remove-cart" title="Xóa sản phẩm khỏi giỏ hàng"><svg viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg></a>
                            <div class="flex">
                                <div class="box-image">
                                    <div class="thumbnail">
                                        <img src="{{ asset('storage/app/public') }}/{{ $item->associatedModel->image }}">
                                    </div>
                                </div>
                                <div class="box-info">
                                    <a href="{{ route('article.product',['slug'=>$item->associatedModel->slug,'id'=>$item->id]) }}">{{ $item->name }}</a>
                                    @if($item->associatedModel->discount_price == null)
                                        <span class="cart-price-mb" style="color: #e7654b;font-weight: 500;">{{ $item->associatedModel->price }}</span><sup style="color: #e7654b">₫</sup><br>
                                        @else
                                            <span class="cart-price-mb" style="color: #e7654b;font-weight: 500;">{{ $item->associatedModel->discount_price }}</span><span style="color: #e7654b"><sup>₫</sup></span>
                                    @endif
                                        <div class="quantity-mb" data-productId="{{$item->associatedModel->id}}">
                                            <input class="cart-quantity-input-mb" name="quantity" value="{{ $item->quantity }}" maxlength="2" max="100" size="1"  data-productid="{{ $item->associatedModel->id }}" id="number{{ $item->associatedModel->id }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
                <div class="col col-md-4 col-12">
                    <div class="purchase_information">
                        <h3 class="mt20">Thông tin mua hàng</h3>
                        <div id="status_message" style="font-size: 13px;color: red"></div>
                        <!--Nếu tồn tại địa chỉ và đã đăng nhập-->
                        @if(isset($customerLocation))
                            <form>
                                <label for="input_email">
                                    <span></span>
                                    <input type="email" name="email" value="{{ Auth::guard('customer')->user()->email }}" placeholder="Địa chỉ email" disabled required id="input_email">
                                </label>
                                <label for="input_full_name">
                                    <span></span>
                                    <input type="text" name="full_name" placeholder="Họ và tên (*)" value="{{ $customerLocation->full_name }}" required id="input_full_name">
                                </label>
                                <label for="input_number_phone">
                                    <span></span>
                                    <input type="text" name="number_phone" placeholder="Số điện thoại (*)" value="{{ $customerLocation->number_phone }}" required id="input_number_phone">
                                </label>
                                <label for="input_location">
                                    <span></span>
                                    <input type="text" name="location" placeholder="Số nhà, đường.. (*)" value="{{ $customerLocation->location }}" required id="input_location">
                                </label>
                                <label for="province">
                                    <select name="province" class="location form-control" id="province" required>
                                        @if (isset($province))
                                        @foreach ($province as $item)
                                            <option value="{{ $item->_name }}" <?php if($customerLocation->province == $item->_name) echo 'selected' ?>>{{ $item->_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </label>
                                <label for="district">
                                    <select name="district" class="location form-control" id="district" required>
                                        @if (isset($district))
                                        @foreach ($district as $item)
                                            <option value="{{ $item->_name }}" <?php if($customerLocation->district == $item->_name) echo 'selected' ?>>{{$item->_prefix}} {{ $item->_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </label>
                                <label for="ward">
                                    <select name="ward" class="form-control" id="ward" required>
                                        @if (isset($ward))
                                        @foreach ($ward as $item)
                                            <option value="{{ $item->_name }}" <?php if($customerLocation->wards == $item->_name) echo 'selected' ?>>{{$item->_prefix}} {{ $item->_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </label>
                                <label for="input_note">
                                    <textarea name="note" type="text" placeholder="Ghi chú" rows="3" id="input_note"></textarea>
                                </label>
                            </form>
                            @else
                                <p style="font-size: 13px">Bạn chưa có địa chỉ mua hàng mặc định nào! <a href="{{ route('create_location.user') }}">Nhấn vào đây</a></p>
                                <form>
                                    <label for="input_email">
                                        <span></span>
                                        <input type="text" placeholder="Địa chỉ email" name="email" required id="input_email">
                                    </label>
                                    @error('full_name') Đia chỉ email không được rỗng @enderror
                                    <label for="input_full_name">
                                        <span></span>
                                        <input type="text" name="full_name" placeholder="Họ và tên (*)" required id="input_full_name">
                                    </label>
                                    <label for="input_number_phone">
                                        <span></span>
                                        <input type="text" name="number_phone" placeholder="Số điện thoại (*)" required id="input_number_phone">
                                    </label>
                                    <label for="input_location">
                                        <span></span>
                                        <input type="text" name="location" placeholder="Số nhà, đường.. (*)" required id="input_location">
                                    </label>
                                    <label for="province">
                                        <select name="province" class="location form-control" id="province" required>
                                            @foreach ($province as $item)
                                                <option value="{{ $item->_name }}">{{ $item->_name }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    <label for="district">
                                        <select name="district" class="location form-control" id="district" required>
                                            <option value="">Chọn Quận/Huyện</option>
                                        </select>
                                    </label>
                                    <label for="ward">
                                        <select name="ward" class="form-control" id="ward" required>
                                            <option value="">Chọn Phường/Xã</option>
                                        </select>
                                    </label>
                                    <label for="input_note">
                                        <textarea name="note" type="text" placeholder="Ghi chú" rows="3" id="input_note"></textarea>
                                    </label>
                                </form>
                        @endif
                        <hr>
                        <div class="total mb20">
                            <p><span>Tổng số lượng: </span><span class="cart-total-quantity">{{ Cart::getTotalQuantity() }}</span></p>
                            <p>
                                <span>Tổng đơn hàng: </span>
                                <span class="cart-total-price" style="padding-right: 0px"><?php echo number_format(Cart::getTotal(), 0, ',', '.') ?></span><span><sup>₫</sup></span>
                            </p>
                        </div>
                        <div class="flex alignC justBW">
                            <button class="cart_order mb20" id="js_cart_order">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12">
                    <div id="empty-cart" class="flex alignC directionC">
                        <h2>GIỎ HÀNG</h2>
                        <span>Chưa có sản phẩm nào trong giỏ của bạn</span>
                        <a href="{{ asset('') }}">Nhấn vào đây để tiếp tục mua sắm</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!--Cart Order Mobie-->
    <div id="cart-rev-mb">
        <div class="cart-rev-mb-flex">
            <ul class="cart-rev-mb-quantity">
                <li>Tổng số lượng: </li>
                <li id="js-cart_total_quantity">{{ Cart::getTotalQuantity() }}</li>
            </ul>
            <ul>
                <li>Tổng đơn hàng: </li>
                <li><div id="js-cart_total_price"><?php echo number_format(Cart::getTotal(), 0, ',', '.') ?></div><sup>₫</sup></li>
            </ul>
        </div>
        <button>Tiếp tục</button>
    </div>
@endsection

@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    @if((isset($cart) && $cart->count() > 0) || (isset($carts) && $carts->count() > 0))
        <script>
            //Xử lý khi tăng giảm số lượng sản phẩm
            @foreach((isset($cart)) ? $cart : $carts as $item)
            function incrementValue<?php (isset($cart)) ? print_r($item->associatedModel->id) : print_r($item->id) ?>(e){
                var value = parseInt(document.getElementById('number<?php (isset($cart)) ? print_r($item->associatedModel->id) : print_r($item->id) ?>').value, 10);
                value = isNaN(value) ? 0 : value;
                if(value<100){
                    value++;
                    document.getElementById('number<?php (isset($cart)) ? print_r($item->associatedModel->id) : print_r($item->id) ?>').value = value;
                    updateCartTotal();
                    var quantity = e.previousElementSibling.value;
                    var productId = e.previousElementSibling.getAttribute('data-productid');
                    ajaxUpdateItemCart(productId,quantity);
                }
            }
            function decrementValue<?php (isset($cart)) ? print_r($item->associatedModel->id) : print_r($item->id) ?>(e){
                var value = parseInt(document.getElementById('number<?php (isset($cart)) ? print_r($item->associatedModel->id) : print_r($item->id) ?>').value, 10);
                value = isNaN(value) ? 0 : value;
                if(value>1){
                    value--;
                    document.getElementById('number<?php (isset($cart)) ? print_r($item->associatedModel->id) : print_r($item->id) ?>').value = value;
                    updateCartTotal();
                    var quantity = e.nextElementSibling.value;
                    var productId = e.nextElementSibling.getAttribute('data-productid');
                    ajaxUpdateItemCart(productId,quantity);
                }
            }
            @endforeach
        </script>
    @endif
    <script>
        $(".location, #ward").select2({});
    </script>
@endsection
