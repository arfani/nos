<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Notice;
use App\Models\Sosmed;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    function home()
    {
        $notice = Notice::latest()->first();
        $faqs = Faq::all();
        $brands = Brand::all();
        $testimonials = Testimonial::where('show', true)->get();
        $categories = Category::all();

        return view('client.index', compact(
            'notice',
            'faqs',
            'brands',
            'testimonials',
            'categories',
        ));
    }

    function promo()
    {
        return view('client.promo.index');
    }
    
    function lelang()
    {
        return view('client.lelang.index');
    }
}
