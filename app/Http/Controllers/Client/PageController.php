<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Sosmed;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function howToOrder()
    {
        $sosmed = Sosmed::all();

        $page = Page::where('name', 'how_to_order')->first();

        return view('client.page.index', compact('sosmed', 'page'));
    }
    
    function howToReturn()
    {
        $sosmed = Sosmed::all();

        $page = Page::where('name', 'how_to_return')->first();

        return view('client.page.index', compact('sosmed', 'page'));
    }

    function paymentMethod()
    {
        $sosmed = Sosmed::all();

        $page = Page::where('name', 'payment_method')->first();

        return view('client.page.index', compact('sosmed', 'page'));
    }
    
    function aboutUs()
    {
        $sosmed = Sosmed::all();

        $page = Page::where('name', 'about_us')->first();

        return view('client.page.index', compact('sosmed', 'page'));
    }
    
    function contact()
    {
        $sosmed = Sosmed::all();

        $page = Page::where('name', 'contact')->first();

        return view('client.page.index', compact('sosmed', 'page'));
    }
}
