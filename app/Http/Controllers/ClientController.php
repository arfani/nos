<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Notice;
use App\Models\Product;
use App\Models\Promo;
use App\Models\Setting;
use App\Models\Sosmed;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    function home()
    {
        $notice = Notice::latest()->first();
        $categories = Category::all();

        // SETTINGS
        $hero_data = Setting::where('section_name', 'hero')->first();
        $hero = [
            'data' => $hero_data,
            'product_pictures' => Product::with(['product_pictures'])->limit($hero_data->show_items)->latest()->get()
        ];

        $promo_data = Setting::where('section_name', 'promo')->first();
        $promo = [
            'data' => $promo_data,
            'items' => Promo::with('product')
                ->where('active', 1)
                ->limit($promo_data->show_items)->latest()->get()
        ];

        $auction_data = Setting::where('section_name', 'auction')->first();
        $auction = [
            'data' => $auction_data,
            'items' => Auction::with('product')
                ->where('active', 1)
                ->limit($auction_data->show_items)->latest()->get()
        ];

        $product_data = Setting::where('section_name', 'product')->first();
        $products = [
            'data' => $product_data,
            'items' => Product::with(['product_pictures', 'promo', 'auction', 'product_variant.product_detail.variant_value.variant'])
                ->where('active', 1)
                ->limit($product_data->show_items)->latest()->get()
        ];

        $testimonial_data = Setting::where('section_name', 'testimonial')->first();
        $testimonial = [
            'data' => $testimonial_data,
            'items' => Testimonial::where('show', true)
                ->limit($testimonial_data->show_items)->latest()->get()
        ];

        $faq_data = Setting::where('section_name', 'faq')->first();
        $faq = [
            'data' => $faq_data,
            'items' => Faq::limit($faq_data->show_items)->latest()->get()
        ];

        $brand_data = Setting::where('section_name', 'brand')->first();
        $brand = [
            'data' => $brand_data,
            'items' => Brand::limit($brand_data->show_items)->latest()->get()
        ];

        return view('client.index', compact(
            'notice',
            'categories',
            'hero',
            'promo',
            'auction',
            'products',
            'testimonial',
            'faq',
            'brand',
        ));
    }

    function promo()
    {
        $promo_data = Setting::where('section_name', 'promo')->first();
        $promo = [
            'data' => $promo_data,
            'items' => Product::whereHas('promo', function ($query) {
                $query->where('active', true);
            })->whereDoesntHave('auction', function ($query) {
                $query->where('active', true);
            })
                // ->limit( 0 // nanti buat disini load more nya dengan limit, sementara dikosongkan dulu agar ga limit)
                ->latest()->get()
        ];

        return view('client.promo.index', compact('promo'));
    }

    function lelang()
    {
        $auction_data = Setting::where('section_name', 'auction')->first();
        $auction = [
            'data' => $auction_data,
            'items' => Auction::with('product')
                ->where('active', 1)
                // ->limit($auction_data->show_items) //sama seperti di promo
                ->latest()->get()
        ];

        return view('client.lelang.index', compact('auction'));
    }
}
