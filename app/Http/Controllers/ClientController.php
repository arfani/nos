<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    function home(){
        $notice = Notice::latest()->first();
        
        return view('client.index', compact(
            'notice'
        ));
    }
}
