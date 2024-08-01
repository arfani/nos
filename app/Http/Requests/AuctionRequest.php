<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AuctionRequest extends FormRequest
{
    protected $errorBag = 'auction_update';

    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required'],
            'active' => ['nullable', 'boolean'],
            'endtime' => ['required'],
            'bid_start' => ['required'],
            'bid_increment' => ['required'],
            'rules' => ['nullable','string'],
            'id' => ['nullable', 'numeric'],
        ];
    }

    function attributes(): array
    {
        return [
            'endtime' => 'Batas waktu',
            'bid_start' => 'Harga awal',
            'bid_increment' => 'Kelipatan',
        ];
    }
}
