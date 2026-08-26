<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSlide;
use App\Models\Attraction;
use App\Models\TourPackage;
use App\Models\Product;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'heroSlides' => HeroSlide::where('is_active', true)->orderBy('sort_order')->get(),
            'attractions' => Attraction::latest()->limit(4)->get(),
            'tourPackages' => TourPackage::latest()->limit(4)->get(),
            'products' => Product::latest()->limit(4)->get(),
            'articles' => Article::where('is_published', true)->latest()->limit(3)->get(),
        ];

        return view('pages.home', $data);
    }
}
