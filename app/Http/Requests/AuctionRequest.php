<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'product_id'    => ['required'],
            'active'        => ['nullable', 'boolean'],

            'endtime'       => [
                Rule::when(
                    $this->input('active') == 1,
                    ['required', 'date', 'after_or_equal:' . now()->toDateTimeString()]
                ),
            ],

            'bid_start'     => [
                Rule::when(
                    $this->input('active') == 1,
                    ['required', 'numeric', 'min:0']
                ),
            ],

            'bid_increment' => [
                Rule::when(
                    $this->input('active') == 1,
                    ['required', 'numeric', 'min:0']
                ),
            ],

            'rules'         => ['nullable', 'string'],
            'id'            => ['nullable', 'numeric'],
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
