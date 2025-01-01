<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Beranda';
        $topArticles = Article::orderBy('clicks', 'desc')->take(5)->get();
        $topProducts = Product::orderBy('clicks', 'desc')->take(5)->get();

        return view('dashboard.home.index', compact('title', 'topArticles', 'topProducts'));
    }
}
