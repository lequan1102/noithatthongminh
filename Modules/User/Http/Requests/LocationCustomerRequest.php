<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'full_name'    => 'required',
            'number_phone' => 'required|min:6',
            'location'     => 'required',
            'province'     => 'required',
            'district'     => 'required',
            'wards'        => 'required',
        ];
    }
    public function messages()
    {
        return [
            'full_name.required'            => 'Họ và tên không được để trống',
            'number_phone.email'            => 'Số điện thoại không được để trống',
            'number_phone.min'              => 'Số điện thoại của bạn quá ngắn',
            'location.required'             => 'Số nhà, đường không nên để trống để giao hàng được chính xác',
            'province.required'             => 'Thành phố không được để trống',
            'district.required'             => 'Đường phố không được để trống',
            'wards.required'                => 'Đường phố không được để trống',
        ];
    }
}
