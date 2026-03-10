<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::with(['category', 'primaryImage', 'images'])->active();

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                  ->orWhere('name_jp', 'like', "%{$search}%")
                  ->orWhere('description_en', 'like', "%{$search}%")
                  ->orWhere('description_jp', 'like', "%{$search}%");
            });
        }

        $vehicles = $query->paginate(12);
        $categories = Category::active()->get();

        return view('public.gallery', compact('vehicles', 'categories'));
    }

    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $vehicles = Vehicle::with(['category', 'images'])
            ->where('category_id', $category->id)
            ->active()
            ->latest()
            ->paginate(12);

        return view('public.vehicle-detail', compact('category', 'vehicles'));
    }
}