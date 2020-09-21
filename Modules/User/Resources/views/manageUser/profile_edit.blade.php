@extends('user::layouts.master')
@section('head')
    <link rel="stylesheet" href="{{ asset('public/templates/libs/select2/select2.min.css') }}">
@endsection
@section('layout')
    <h2>Thông tin cá nhân</h2>
    <div class="about-account--content my-profile p40">
        <form action="{{ route('profile.edit.submit.user', ['id'=>$myProfile->id]) }}" method="POST">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col col-sm-4 col-12 clear-p">
                    <div class="my-profile-item mb30">
                        <div class="my-profile-item-title">
                            Họ tên
                        </div>
                        <div class="my-profile-item-info">
                            <input type="text" name="name" placeholder="Họ tên của bạn" value="{{ $myProfile->name }}">
                        </div>
                    </div>
                </div>
                <div class="col col-sm-4 col-12 clear-p">
                    <div class="my-profile-item mb30">
                        <div class="my-profile-item-title">
                            Địa chỉ email
                        </div>
                        <div class="my-profile-item-info" style="padding-top: 5px">
                            {{ $myProfile->email }}
                        </div>
                    </div>
                </div>
                <div class="col col-sm-4 col-12 clear-p">
                    <div class="my-profile-item mb30">
                        <div class="my-profile-item-title">
                            Số điện thoại
                        </div>
                        <div class="my-profile-item-info" style="padding-top: 5px">
                            {{ $myProfile->phone }}
                        </div>
                    </div>
                </div>
                <div class="col col-sm-4 col-12 clear-p">
                    <div class="my-profile-item mb30">
                        <div class="my-profile-item-title">
                            Ngày sinh
                        </div>
                        <?php
                            $date = array('1','0','2020');
                            if(isset($myProfile->date)){
                                $date = explode('-',$myProfile->date);
                            }
                            $day = array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');
                            $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                            $years = array_combine(range(date("Y"), 1910), range(date("Y"), 1910));
                        ?>
                        <div class="my-profile-item-info date">
                            <select name="d">
                                @foreach ($day as $index => $item)
                                    <option value="<?php if(strlen($index+1) == 1) echo '0' ?>{{ $index+1 }}" <?php if($date[0] == $item) echo 'selected' ?>>{{ $item }}</option>
                                @endforeach
                            </select>
                            <select name="m">
                                @foreach ($months as $index => $item)
                                    <option value="<?php if(strlen($index+1) == 1) echo '0' ?>{{ $index+1 }}" <?php if($date[1] == $index) echo 'selected' ?>>{{ $item }}</option>
                                @endforeach
                            </select>
                            <select name="y">
                                @foreach ($years as $index => $item)
                                    <option value="{{ $index }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col col-sm-4 col-12 clear-p">
                    <div class="my-profile-item mb30">
                        <div class="my-profile-item-title">
                            Giới Tính
                        </div>
                        <div class="my-profile-item-info">
                            <select name="gender" style="padding: 8px;border: 1px solid #ececec;outline: none;">
                                <option value="Nam" <?php if($myProfile->gender == 'Nam') echo 'selected' ?>>Nam</option>
                                <option value="Nữ" <?php if($myProfile->gender == 'Nữ') echo 'selected' ?>>Nữ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col col-12 my-profile-ft clear-p">
                    <button>Lưu thay đổi</button>
                </div>
            </div>
        </div>
        </form>
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
