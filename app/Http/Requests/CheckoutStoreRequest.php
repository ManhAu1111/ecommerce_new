<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutStoreRequest extends FormRequest
{
    /**
     * Cho phép request này được thực thi
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules validate
     */
    public function rules(): array
    {
        return [

            // Thông tin người nhận
            'receiver_name' => ['required', 'string', 'max:255'],

            'receiver_phone' => [
                'required',
                'regex:/^(0|\+84)[0-9]{9}$/'
            ],

            'receiver_email' => ['nullable', 'email', 'max:255'],

            // Địa chỉ
            'province' => ['required'],
            'district' => ['required'],
            'ward' => ['required'],
            'detail' => ['required', 'string', 'max:255'],
            'full_address' => ['required', 'string'],

            // Thanh toán
            'payment_method' => ['required', 'in:cod,momo'],

            // Ghi chú
            'note' => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * Custom message tiếng Việt
     */
    public function messages(): array
    {
        return [
            'receiver_name.required' => 'Vui lòng nhập họ tên người nhận.',
            'receiver_name.max' => 'Họ tên không được vượt quá 255 ký tự.',

            'receiver_phone.required' => 'Vui lòng nhập số điện thoại.',
            'receiver_phone.regex' => 'Số điện thoại không hợp lệ (VD: 0901234567).',

            'receiver_email.email' => 'Email không đúng định dạng.',

            'province.required' => 'Vui lòng chọn tỉnh/thành phố.',
            'district.required' => 'Vui lòng chọn quận/huyện.',
            'ward.required' => 'Vui lòng chọn phường/xã.',

            'detail.required' => 'Vui lòng nhập địa chỉ chi tiết.',
            'detail.max' => 'Địa chỉ chi tiết không được quá 255 ký tự.',

            'full_address.required' => 'Địa chỉ đầy đủ không hợp lệ.',

            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
            'payment_method.in' => 'Phương thức thanh toán không hợp lệ.',

            'note.max' => 'Ghi chú không được vượt quá 500 ký tự.',
        ];
    }

    /**
     * Chuẩn hóa dữ liệu trước khi validate (quan trọng)
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'receiver_name' => trim($this->receiver_name),
            'receiver_phone' => trim($this->receiver_phone),
            'receiver_email' => trim($this->receiver_email),
            'detail' => trim($this->detail),
        ]);
    }
}
