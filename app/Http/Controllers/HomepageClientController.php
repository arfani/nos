<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Brand;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Promo;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomepageClientController extends Controller
{
    function index(): View
    {
        // SETTINGS
        $hero = Setting::where('section_name', 'hero')->first();

        $promo = Setting::where('section_name', 'promo')->first();

        $auction = Setting::where('section_name', 'auction')->first();

        $products = Setting::where('section_name', 'product')->first();

        $testimonial = Setting::where('section_name', 'testimonial')->first();

        $faq = Setting::where('section_name', 'faq')->first();

        $brand = Setting::where('section_name', 'brand')->first();

        return view('admin.homepage-client.index', compact('hero'));
    }

    function update(Request $request, $section_name)
    {
        $hero = Setting::where('section_name', $section_name)->first();
        $hero->update($request->all());

        return redirect()->back()->with('success', 'Data Hero berhasil diupdate!');
    }
}
