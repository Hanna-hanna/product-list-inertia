<?php

namespace App\Domains\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'rank' => 'nullable|integer|min:0',
            'image' => 'nullable|file|max:2048'
        ];
    }
}
