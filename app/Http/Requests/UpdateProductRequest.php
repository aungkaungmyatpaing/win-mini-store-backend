<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'myanmar_colors' => 'array',
            'myanmar_colors.*' => 'exists:product_colors,myanmar_name',
            'english_colors' => 'array',
            'english_colors.*' => 'exists:product_colors,english_name',
            'sizes' => 'array',
            'sizes.*' => 'exists:sizes,id',
            'whole_sale_quantity' => 'nullable',
            'whole_sale_price' => 'nullable',
            'instock_amount' => 'required|integer',
        ];

        if ($this->instock) {
            $rules['instock'] = 'in:1,0';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'sizes.exists' => 'Product size does not exists',
        ];
    }
}
