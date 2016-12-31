<?php

namespace App\Http\Controllers;

use App\Models\Article;

final class PageController extends Controller 
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(4);
        return view('pages.index')
            ->with([ 'newsArticles' => $articles ]);
    }
    
    public function about()
    {
        return view('pages.about');
    }
    
    public function feed()
    {
        return view('pages.feed.landing');
    }
    
    public function servers()
    {
        return view('pages.servers');
    }
}
