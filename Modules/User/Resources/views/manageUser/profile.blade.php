@extends('user::layouts.master')
@section('head')
    <link rel="stylesheet" href="{{ asset('public/templates/libs/select2/select2.min.css') }}">
@endsection
@section('layout')
    <h2>Thông tin cá nhân</h2>
    <div class="about-account--content my-profile p40">
        <div class="container">
            <div class="row">
                <div class="col col-sm-4 col-12 clear-p">
                    <div class="my-profile-item mb30">
                        <div class="my-profile-item-title">
                            Họ tên
                        </div>
                        <div class="my-profile-item-info">
                            @if ($myProfile->name != null)
                                {{ $myProfile->name }}
                                @else
                                    chưa cập nhật  
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col col-sm-4 col-12 clear-p">
                    <div class="my-profile-item mb30">
                        <div class="my-profile-item-title">
                            Địa chỉ email
                        </div>
                        <div class="my-profile-item-info">
                            @if ($myProfile->email != null)
                                {{ $myProfile->email }}
                                @else
                                    chưa cập nhật  
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col col-sm-4 col-12 clear-p">
                    <div class="my-profile-item mb30">
                        <div class="my-profile-item-title">
                            Số điện thoại
                        </div>
                        <div class="my-profile-item-info">
                            @if ($myProfile->phone != null)
                                {{ $myProfile->phone }}
                                @else
                                    chưa cập nhật  
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col col-sm-4 col-12 clear-p">
                    <div class="my-profile-item mb30">
                        <div class="my-profile-item-title">
                            Ngày sinh
                        </div>
                        <div class="my-profile-item-info">
                            @if ($myProfile->date != null)
                                {{ $myProfile->date }}
                                @else
                                    chưa cập nhật  
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col col-sm-4 col-12 clear-p">
                    <div class="my-profile-item mb30">
                        <div class="my-profile-item-title">
                            Giới Tính
                        </div>
                        <div class="my-profile-item-info">
                            @if ($myProfile->gender != null)
                                {{ $myProfile->gender }}
                                @else
                                    chưa cập nhật  
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col col-12 my-profile-ft clear-p">
                    <a href="{{ route('profile.edit.user', ['id'=>$myProfile->id]) }}">Sửa thông tin</a>
                    <a href="#">Thay đổi mật khẩu</a>
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
