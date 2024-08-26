<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function index1()
    {
        return view('pages.about');
    }

    public function index2()
    {
        return view('pages.service');
    }

    public function index3()
    {
        return view('pages.contact');
    }

    public function index4()
    {
        return view('pages.products');
    }
}
