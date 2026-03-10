<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;

class ServiceController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'services')->firstOrFail();
        return view('public.services', compact('page'));
    }
}