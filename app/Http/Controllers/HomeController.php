<?php

namespace App\Http\Controllers;

use App\Models\CultivationPublication;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recentPublications = CultivationPublication::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();
            
        $categories = Category::withCount('cultivationPublications')
            ->orderBy('cultivation_publications_count', 'desc')
            ->take(10)
            ->get();
            
        return view('home', compact('recentPublications', 'categories'));
    }
}