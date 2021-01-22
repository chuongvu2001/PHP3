<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:4',
            'detail' => "max:50"
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Hãy nhập tên danh mục",
            'name.min' => "Ít nhất có 4 ký tự",
            'detail.max' => "Không được vượt quá 50 ký tự"
        ];
    }
}
