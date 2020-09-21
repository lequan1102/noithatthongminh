@extends('user::layouts.master')
@section('head')

@endsection
@section('layout')
    <h2>Sổ địa chỉ</h2>
    <div class="layout-address-acount">
        <table>
            <thead>
            <tr>
                <th><div>Tên khách hàng</div></th>
                <th><div>Sổ</div></th>
                <th><div>Địa chỉ</div></th>
                <th><div>Số điện thoại</div></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if($favorite->count() > 0)
                @foreach($favorite as $index => $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            @if($item->default != 'on')
                            <a href="{{ route('del.location.user',['id'=>$item->id]) }}" onclick="confirmDel()" title="xóa địa chỉ" style="color: #ff7e7e" href="#"><svg style="width: 14px" viewBox="0 0 448 512"><path fill="currentColor" d="M440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h18.9l33.2 372.3a48 48 0 0 0 47.8 43.7h232.2a48 48 0 0 0 47.8-43.7L421.1 96H440a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zm184.8 427a15.91 15.91 0 0 1-15.9 14.6H107.9A15.91 15.91 0 0 1 92 465.4L59 96h330z"></path></svg></a>
                            @endif
                            <a title="chỉnh sửa" style="color: #2a9bff" href="{{ route('edit.location.user', ['id'=>$item->id]) }}"><svg style="width: 14px" viewBox="0 0 512 512"><path fill="currentColor" d="M493.25 56.26l-37.51-37.51C443.25 6.25 426.87 0 410.49 0s-32.76 6.25-45.26 18.74L12.85 371.12.15 485.34C-1.45 499.72 9.88 512 23.95 512c.89 0 1.78-.05 2.69-.15l114.14-12.61 352.48-352.48c24.99-24.99 24.99-65.51-.01-90.5zM126.09 468.68l-93.03 10.31 10.36-93.17 263.89-263.89 82.77 82.77-263.99 263.98zm344.54-344.54l-57.93 57.93-82.77-82.77 57.93-57.93c6.04-6.04 14.08-9.37 22.63-9.37 8.55 0 16.58 3.33 22.63 9.37l37.51 37.51c12.47 12.48 12.47 32.78 0 45.26z"></path></svg></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <a href="{{ route('create_location.user') }}" class="button-add-location">Thêm địa chỉ mới</a>
@endsection
@section('footer')
    <script>
        function confirmDel(){
            let del = confirm('Bạn có muốn xóa địa chỉ này!');
            if(del){
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
