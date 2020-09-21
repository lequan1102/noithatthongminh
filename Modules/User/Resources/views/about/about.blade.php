@extends('layouts.master')
@section('title')
Thông tin cá nhân
@endsection
@section('layout')
    <div class="about-account--content">
        <form action="" class="add-location">
        <div class="row" style="padding: 30px">
            <div class="col col-md-6 col-12">
                <label for="">
                    <span>Tên</span>
                    <input type="text" placeholder="Họ tên">
                </label>
            </div>
            <div class="col col-md-6 col-12">
                <label for="">
                    <span>Số điện thoại</span>
                    <input type="text" placeholder="Vui lòng điền số điện thoại của bạn">
                </label>
            </div>
            <div class="col col-md-6 col-12">
                <label for="">
                    <span>Địa chỉ nhận hàng</span>
                    <input type="text" placeholder="Vui lòng chọn địa chỉ của bạn vd: số nhà..">
                </label>
            </div>
            <div class="col col-md-6 col-12">
                <label for="">
                    <span>Tỉnh/ Thành phố</span>
                    <input type="text" placeholder="Vui lòng chọn tỉnh/ thành phố">
                </label>
            </div>
            <div class="col col-md-6 col-12">
                <label for="">
                    <span>Quận/ Huyện</span>
                    <input type="text" placeholder="Vui lòng chọn quận huyện">
                </label>
            </div>
            <div class="col col-md-6 col-12">
                <label for="">
                    <span>Phường/ Xã</span>
                    <input type="text" placeholder="Vui lòng chọn phường/xã">
                </label>
            </div>
            <div class="col col-md-6 col-12">
                <div class="location-default">
                    <label for="default">
                        <input type="checkbox" name="default" id="default">
                        Đặt làm địa chỉ mặc định
                    </label>
                </div>
            </div>
        </div>
        <div class="flex button-create-location">
            <button class="canel">Hủy</button>
            <button class="save">Lưu</button>
        </div>
    </form>
    </div>
@endsection
@section('footer')

@endsection
