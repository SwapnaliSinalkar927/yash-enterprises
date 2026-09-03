<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('web.index');
    }

    public function aboutUs()
    {
        return view('web.about-us');
    }

    public function services()
    {
        return view('web.services');
    }

    public function contactUs(){
        return view('web.contact-us');
    }
}
