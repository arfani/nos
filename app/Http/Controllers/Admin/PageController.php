<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function howToOrder(): View
    {
        $form_name = 'Cara Belanja';
        $data = Page::where('name', 'how_to_order')->first();
        $update_route = route('admin.how-to-order-update', $data->id);

        return view('admin.page.index', compact('data', 'form_name', 'update_route'));
    }

    function howToOrderUpdate(Request $request, Page $page)
    {
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();

        return redirect()->route('admin.how-to-order')->with('success', 'Data berhasil diupdate');
    }

    function howToReturn(): View
    {
        $form_name = 'Cara Pengembalian';
        $data = Page::where('name', 'how_to_return')->first();
        $update_route = route('admin.how-to-return-update', $data->id);

        return view('admin.page.index', compact('data', 'form_name', 'update_route'));
    }

    function howToReturnUpdate(Request $request, Page $page)
    {
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();

        return redirect()->route('admin.how-to-return')->with('success', 'Data berhasil diupdate');
    }
    
    function paymentMethod(): View
    {
        $form_name = 'Metode Pembayaran';
        $data = Page::where('name', 'payment_method')->first();
        $update_route = route('admin.payment-method-update', $data->id);

        return view('admin.page.index', compact('data', 'form_name', 'update_route'));
    }

    function paymentMethodUpdate(Request $request, Page $page)
    {
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();

        return redirect()->route('admin.payment-method')->with('success', 'Data berhasil diupdate');
    }

    function aboutUs(): View
    {
        $form_name = 'Tentang Kami';
        $data = Page::where('name', 'about_us')->first();
        $update_route = route('admin.about-us-update', $data->id);

        return view('admin.page.index', compact('data', 'form_name', 'update_route'));
    }

    function aboutUsUpdate(Request $request, Page $page)
    {
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();

        return redirect()->route('admin.about-us')->with('success', 'Data berhasil diupdate');
    }
    
    function contact(): View
    {
        $form_name = 'Kontak Kami';
        $data = Page::where('name', 'contact')->first();
        $update_route = route('admin.contact-update', $data->id);

        return view('admin.page.index', compact('data', 'form_name', 'update_route'));
    }

    function contactUpdate(Request $request, Page $page)
    {
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();

        return redirect()->route('admin.contact')->with('success', 'Data berhasil diupdate');
    }
}
