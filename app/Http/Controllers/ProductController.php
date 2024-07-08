<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
    
    function productsByCategory($category): View
    {
        // get prduct where category is $category and then pass to view
        //

        return view('client.product.index');
    }
}
