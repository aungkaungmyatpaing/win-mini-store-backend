<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TownshipRequest extends FormRequest
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
        return [
            'region_id' => 'required|exists:regions,id',
            'name' => 'required|string|max:255',
            'name_mm' => 'required|string|max:255',
            'cod' => 'nullable|boolean',
            'delivery_fee' => 'required|integer|min:0',
            'duration' => 'nullable|integer|min:0',
            'remark' => 'nullable|string|max:255',
        ];
    }
}
