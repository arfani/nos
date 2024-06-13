<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    function home(Request $request){
        return view('client.index');
    }
}
