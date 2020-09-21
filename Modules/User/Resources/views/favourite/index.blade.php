@extends('user::layouts.master')
@section('title') Danh sách yêu thích @endsection
@section('header')
    
@endsection
@section('layout')
    <h2>Danh sách yêu thích</h2>
    <div class="favourite p40">
        @if (isset($exists_favourite))
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product_favourite as $item)
                <tr>
                    <td>
                        <div class="thumbnail">
                            <img src="{{Voyager::image($item->image)}}">
                        </div>
                    </td>
                    <td>{{$item->title}}</td>
                    <td><button ></button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            khong co
        @endif
    </div>
@endsection
@section('footer')

@endsection