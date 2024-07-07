<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Sosmed;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function howToOrder()
    {
        $page = Page::where('name', 'how_to_order')->first();

        return view('client.page.index', compact('page'));
    }

    function howToReturn()
    {
        $page = Page::where('name', 'how_to_return')->first();

        return view('client.page.index', compact('page'));
    }

    function paymentMethod()
    {
        $page = Page::where('name', 'payment_method')->first();

        return view('client.page.index', compact('page'));
    }

    function aboutUs()
    {
        $page = Page::where('name', 'about_us')->first();

        return view('client.page.index', compact('page'));
    }

    function contact()
    {
        $page = Page::where('name', 'contact')->first();

        return view('client.page.index', compact('page'));
    }

    // FOR ADMIN CRUD
    function howToOrderAdmin(): View
    {
        $form_name = 'Cara Belanja';
        $data = Page::where('name', 'how_to_order')->first();
        $update_route = route('admin.how-to-order-update', $data->id);

        return view('admin.page.index', compact('data', 'form_name', 'update_route'));
    }

    function howToOrderUpdateAdmin(Request $request, Page $page)
    {
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();

        return redirect()->route('admin.how-to-order')->with('success', 'Data berhasil diupdate');
    }

    function howToReturnAdmin(): View
    {
        $form_name = 'Cara Pengembalian';
        $data = Page::where('name', 'how_to_return')->first();
        $update_route = route('admin.how-to-return-update', $data->id);

        return view('admin.page.index', compact('data', 'form_name', 'update_route'));
    }

    function howToReturnUpdateAdmin(Request $request, Page $page)
    {
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();

        return redirect()->route('admin.how-to-return')->with('success', 'Data berhasil diupdate');
    }

    function paymentMethodAdmin(): View
    {
        $form_name = 'Metode Pembayaran';
        $data = Page::where('name', 'payment_method')->first();
        $update_route = route('admin.payment-method-update', $data->id);

        return view('admin.page.index', compact('data', 'form_name', 'update_route'));
    }

    function paymentMethodUpdateAdmin(Request $request, Page $page)
    {
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();

        return redirect()->route('admin.payment-method')->with('success', 'Data berhasil diupdate');
    }

    function aboutUsAdmin(): View
    {
        $form_name = 'Tentang Kami';
        $data = Page::where('name', 'about_us')->first();
        $update_route = route('admin.about-us-update', $data->id);

        return view('admin.page.index', compact('data', 'form_name', 'update_route'));
    }

    function aboutUsUpdateAdmin(Request $request, Page $page)
    {
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();

        return redirect()->route('admin.about-us')->with('success', 'Data berhasil diupdate');
    }

    function contactAdmin(): View
    {
        $form_name = 'Kontak Kami';
        $data = Page::where('name', 'contact')->first();
        $update_route = route('admin.contact-update', $data->id);

        return view('admin.page.index', compact('data', 'form_name', 'update_route'));
    }

    function contactUpdateAdmin(Request $request, Page $page)
    {
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();

        return redirect()->route('admin.contact')->with('success', 'Data berhasil diupdate');
    }
}
