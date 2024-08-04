<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name' => ['required', Rule::unique(Product::class)->ignore($this->product)],
            'stock' => ['nullable', 'numeric'],
            'price' => ['nullable', 'numeric'],
            'weight' => ['nullable', 'numeric'],
            'sku' => ['nullable', 'string', Rule::unique(ProductVariant::class)->ignore($this->product->product_variant[0])],
            'active' => ['required', 'boolean'],
            'description' => ['nullable', 'string'],
            'categories' => ['nullable'],
            'product_pictures' => ['nullable'],
            'deleted_pictures' => ['nullable'],
            'discount' => ['nullable'],
            'length' => ['nullable'],
            'width' => ['nullable'],
            'height' => ['nullable'],
            'detail' => ['nullable'],
            'detail-value' => ['nullable'],
        ];
    }

    function messages() {
        return [
            'name.unique' => 'Nama produk ini sudah ada.'
        ];
    }
}
