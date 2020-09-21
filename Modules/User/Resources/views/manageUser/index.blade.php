@extends('user::layouts.master')
@section('head')
    <link rel="stylesheet" href="{{ asset('public/templates/libs/select2/select2.min.css') }}">
@endsection
@section('layout')
    <h2>Quản lý tài khoản</h2>
    <div class="about-account--content">
        <div class="container">
            <div class="row">
                <div class="col col-sm-6 col-12 clear-p">
                    <div class="dashbroad-profile">
                        <div class="dashboard-mod-title">
                            <h4>Thông tin tài khoản</h4>
                            <a href="#">Chỉnh sửa</a>
                        </div>
                        <span>Trẻ Con</span><br>
                        <span>htmattroi@gmail.com</span>
                    </div>
                </div>
                <div class="col col-sm-6 col-12 clear-p">
                    <div class="dashbroad-address">
                        @if ($customerLocation == null)
                            <div class="dashboard-mod-title">
                                <h4>Sổ địa chỉ</h4>
                                <a href="{{ route('create_location.user') }}">Thêm mới</a>
                            </div>
                            <p style="color: #757575;">Hiện tại bạn chưa có địa chỉ nhận hàng mặc định nào</p>
                            @else
                            <div class="dashboard-mod-title">
                                <h4>Sổ địa chỉ</h4>
                                <a href="{{ route('edit.location.user', ['id'=>$customerLocation->id]) }}">Chỉnh sửa</a>
                            </div>
                                <p style="color: #757575;">Địa chỉ nhận hàng mặc định</p>
                                <b>{{ $customerLocation->full_name }}</b>
                                <br>
                                <span>{{ $customerLocation->location }}</span>
                                <br>
                                <span>{{ $customerLocation->wards }} - {{ $customerLocation->district }} - {{ $customerLocation->province }}</span>
                                
                                <span> - (SĐT) {{ $customerLocation->number_phone }}</span>
                        @endif
                        
                    </div>
                </div>
                <div class="col col-12">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ asset('public/templates/libs/select2/select2.full.min.js') }}"></script>
    <script>
        $("#thanhpho").select2({
          tags: true
        });
    </script>
@endsection
