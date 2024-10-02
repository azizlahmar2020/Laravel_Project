<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class frontofficeController extends Controller
{
    //

    public function index()
    {
        return view('frontoffice.home');
    }
}
