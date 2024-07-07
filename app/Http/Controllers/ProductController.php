<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    function allProducts(): View
    {
        return view('client.product.index');
    }

    function productById(): View
    {
        return view('client.product.detail');
    }
}
