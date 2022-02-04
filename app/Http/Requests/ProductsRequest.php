<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
    public function messages()
    {
        return [
            'name.required' => 'Поле "Наименование товара" обязательно для заполнения',
            'sort.integer' => 'Номер сортровки должен быть целым числом',
            'img.image' => 'Должен быть агружен файл изображения',
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'sort' => 'integer|nullable',
            'img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg'
        ];
    }
}
