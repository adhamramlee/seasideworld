<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'about-us')->firstOrFail();
        return view('public.about', compact('page'));
    }
}