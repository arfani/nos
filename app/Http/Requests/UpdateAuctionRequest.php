<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAuctionRequest extends FormRequest
{

    protected $errorBag = 'auction_update';
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
            'active' => ['required'],
            'endtime' => ['required'],
            'bid_start' => ['required'],
            'bid_increment' => ['required'],
            'rules' => ['nullable'],
        ];
    }

    /**
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    function attributes() : array {
        return [
            'endtime' => 'Batas waktu',
            'bid_start' => 'Harga awal',
            'bid_increment' => 'Kelipatan',
        ];        
    }
}
