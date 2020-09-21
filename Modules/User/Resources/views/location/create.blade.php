@extends('user::layouts.master')
@section('head')
    <link rel="stylesheet" href="{{ asset('public/templates/libs/select2/select2.min.css') }}">
    <style>
        .select2-container--default .select2-selection--single {
            height: 37px;
            border: 1px solid #ececec;
            border-radius: 2px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 37px;
        }
    </style>
@endsection
@section('layout')
    <h2>Sổ địa chỉ</h2>
    <div class="layout-address-acount">
        <form action="{{ route('submit.create.location.user') }}" method="POST" class="add-location">
            @csrf
            <div class="row" style="padding: 30px">
                <div class="col col-md-6 col-12">
                    <label for="">
                        <span>Tên</span>
                        <input type="text" placeholder="Họ tên" name="full_name" required>
                    </label>
                </div>
                <div class="col col-md-6 col-12">
                    <label for="">
                        <span>Số điện thoại</span>
                        <input type="text" placeholder="Vui lòng điền số điện thoại của bạn" name="number_phone" required>
                    </label>
                </div>
                <div class="col col-md-6 col-12">
                    <label for="">
                        <span>Địa chỉ nhận hàng</span>
                        <input type="text" placeholder="Vui lòng chọn địa chỉ của bạn vd: số nhà.." name="location" required>
                    </label>
                </div>
                <div class="col col-md-6 col-12">
                    <label for="thanhpho">
                        <span>Tỉnh/ Thành phố</span>
                        <select class="location" name="province" id="province" style="width: 100%; border: 1px solid #ececec" required>
                            <option>Vui lòng chọn Thành Phố</option>
                            @foreach ($province as $item)
                                <option value="{{ $item->_name }}">{{ $item->_name }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="col col-md-6 col-12">
                    <label for="">
                        <span>Quận/ Huyện</span>
                        <select class="location" name="district" id="district" style="width: 100%; border: 1px solid #ececec" required>
                            <option value="">Vui lòng chọn Quận/Huyện</option>
                        </select>
                    </label>
                </div>
                <div class="col col-md-6 col-12">
                    <label for="">
                        <span>Phường/ Xã</span>
                        <select class="location" name="wards" id="ward" style="width: 100%; border: 1px solid #ececec" required>
                            <option value="">Vui lòng chọn Phường/Xã</option>
                        </select>
                    </label>
                </div>
                <div class="col col-md-6 col-12">
                    <div class="location-default mt30">
                        <label for="default">
                            <input type="checkbox" name="default" id="default">
                            Đặt làm địa chỉ mặc định
                        </label>
                    </div>
                </div>
            </div>
            <div class="flex button-create-location">
                <a class="canel" href="{{ route('location.user') }}">Hủy</a>
                <button class="save" type="submit">Lưu</button>
            </div>
        </form>
    </div>
@endsection
@section('footer')
    <script src="{{ asset('public/templates/libs/select2/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".location").select2();
            $('.location').change(function (e) {
                e.preventDefault();
                let currentId = $(this).attr('id');
                let typeId = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('loadLocation') }}",
                    data: {
                        'typeId' : typeId,
                        'type': currentId,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        
                        let html = '';
                        let element = '';
                        if (currentId == 'province'){
                            html = '<option value="">Vui lòng chọn Quận/Huyện</option>';
                            element = '#district';
                            $.each(response.data, function (index, item) { 
                                html += '<option value="'+ item._name +'">'+ item._name +'</option>';
                            });
                            $('#ward').html('').append('<option value="">Vui lòng chọn Phường/Xã</option>');
                        } else if (currentId == 'district') {
                            html = '<option value="">Vui lòng chọn Phường/Xã</option>';
                            element = '#ward';
                            $.each(response.data, function (index, item) {
                                html += '<option value="'+ item._name +'">'+ item._name +'</option>';
                            });
                        }
                        $(element).html('').append(html);
                    }
                });
            });
        });
    </script>
@endsection
