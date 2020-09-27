@extends('layouts.master')
@section('title')Đăng ký thành viên @endsection

@section('layout')
<!-- Sign In -->
<section id="login-user" class="container sign-in mt40 mb40">
    <form method="POST" action="{{ route('login.signup.submit') }}">
        @csrf
        <h2 class="text-center">Đăng ký tài khoản</h2>
        <label for="name">
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Họ và tên" required>
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </label>
        <label for="email">
            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Địa chỉ email của bạn" required>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </label>
        <label for="phone">
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Số điện thoại của bạn" required>
            @error('phone')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </label>
        <label for="password">
            <input type="text" name="password" id="password" value="{{ old('password') }}" placeholder="Mật khẩu" required>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </label>
        <label for="re-pass">
            <input type="text" name="password_confirmation" id="re-pass" value="{{ old('password_confirmation') }}" placeholder="Nhập lại mật khẩu" required>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </label>
        <div class="form-group">
            <input type="checkbox" name="agreeterm" id="agreeterm" class="agreeterm"  style="transform: translateY(2px)">
            <label for="agreeterm" class="label-agree-term">
                <span><span></span></span>Tôi đồng ý tất cả các tuyên bố trong<a href="#" style="margin-left: 5px" class="term-service">Điều khoản dịch vụ</a>
            </label>
            @error('agreeterm')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Đăng ký ngay</button>
        <a href="{{ route('login') }}" class="signup-image-link" style="font-size: 15px;color: #e7654b;margin-top: 10px;display: block;">Tôi đã là thành viên</a>
    </form>
    
</section>
    <!-- Form đăng ký -->
    {{-- <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Đăng ký</h2>
                    <form method="POST" action="{{ route('login.signup.submit') }}"  class="register-form" id="register-form">
                        @csrf
                        <div class="form-group">
                            <div class="fiedset">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Họ và tên">
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="fiedset">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" value="{{ old('email') }}" name="email" id="email" placeholder="Địa chỉ email của bạn">
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="fiedset">
                                <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                                <input type="number" value="{{ old('phone') }}" name="phone" id="phone" placeholder="Số điện thoại của bạn">
                            </div>
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="fiedset">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" value="{{ old('password') }}" name="password" id="pass" placeholder="Mật khẩu">
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="fiedset">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" value="{{ old('password_confirmation') }}" name="password_confirmation" id="re_pass" placeholder="Nhập lại mật khẩu">
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agreeterm" id="agreeterm" class="agreeterm" />
                            <label for="agreeterm" class="label-agree-term">
                                <span><span></span></span>
                                Tôi đồng ý tất cả các tuyên bố trong
                                <a href="#" class="term-service">Điều khoản dịch vụ</a>
                            </label>
                            @error('agreeterm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" id="signup" class="form-submit" value="Đăng ký">
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="{{ asset('/public/templates/libs/authenlicate/images/signup-image.jpg') }}" alt="sing up image"></figure>
                    <a href="{{ route('login') }}" class="signup-image-link">Tôi đã là thành viên</a>
                </div>
            </div>
        </div>
    </section> --}}
@endsection



