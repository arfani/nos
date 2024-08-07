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
        $hero = Setting::firstWhere('section_name', 'hero');

        $promo = Setting::firstWhere('section_name', 'promo');

        $auction = Setting::firstWhere('section_name', 'auction');

        $product = Setting::firstWhere('section_name', 'product');

        $testimonial = Setting::firstWhere('section_name', 'testimonial');

        $faq = Setting::firstWhere('section_name', 'faq');

        $brand = Setting::firstWhere('section_name', 'brand');

        return view('admin.homepage-client.index', compact(
            'hero',
            'promo',
            'auction',
            'product',
            'testimonial',
            'faq',
            'brand',
        ));
    }

    function update(Request $request, $section_name)
    {
        $request->validate([
            'title' => ['required'],
            'show_items' => ['numeric', 'min:1', 'max:100']
        ], [
            'title.required' => 'Judul tidak boleh kosong!'
        ], []);

        $data = Setting::firstWhere('section_name', $section_name);
        $data->update($request->all());

        $section_name = $section_name === 'auction' ? 'lelang' : $section_name;
        return redirect()->back()->with('success', 'Data ' . $section_name . ' berhasil diupdate!');
    }
}
