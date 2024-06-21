<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Notice;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    function home(){
        $notice = Notice::latest()->first();
        $faqs = Faq::all();
        
        return view('client.index', compact(
            'notice',
            'faqs'
        ));
    }
}
