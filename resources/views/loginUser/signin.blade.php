@extends('layouts.master')
@section('title')Đăng nhập thành viên @endsection

@section('layout')
<!-- Sign In -->
<section id="login-user" class="container sign-in mt40 mb40">
    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <h2 class="text-center">Đăng nhập ngay!</h2>
        @if (session()->has('error'))
            {!! session()->get('error') !!}
        @endif
        <label for="email">
            <input type="email" name="email" placeholder="Vui lòng nhập địa chỉ email của bạn" id="email" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </label>
        <label for="password">
            <input type="password" name="password" placeholder="Mật khẩu của bạn" id="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </label>
        <button type="submit">Đăng nhập</button>
        <a href="{{ route('login.signup') }}" class="signup-image-link" style="font-size: 15px;color: #e7654b;margin-top: 10px;display: block;">Tạo một tài khoản</a>
    </form>
</section>
@endsection
