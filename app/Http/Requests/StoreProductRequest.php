<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique(Product::class)],
            'stock' => ['nullable', 'numeric'],
            'price' => ['nullable', 'numeric'],
            'weight' => ['nullable', 'numeric'],
            'sku' => ['nullable', 'string'],
            'active' => ['required', 'boolean'],
            'desc' => ['nullable', 'string'],
            'categories' => ['nullable'],
        ];
    }

    function messages() {
        return [
            'name.unique' => 'Nama produk ini sudah ada.'
        ];
    }
}
