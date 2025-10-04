<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function index()
    {
        $heroArticles = Article::with('author', 'category')->where('status', 'published')->latest()->take(3)->get();
        $miniArticles = Article::with('author', 'category')->where('status', 'published')->latest()->take(4)->get();
        $latestArticles = Article::with('author', 'category')->where('status', 'published')->latest()->take(5)->get();

        $premiumArticles = Article::with('author')->where('status', 'published')
            ->where('category_id', '!=', '1')
            ->inRandomOrder()
            ->take(6)
            ->get();

        $catArticles = Article::with('author', 'category')->where('status', 'published')->where('category_id', 1)->inRandomOrder()->take(3)->get();
        $sideArticles = Article::with('author', 'category')->where('status', 'published')->where('category_id', '!=', 1)->inRandomOrder()->take(3)->get();

        return view('homepage.index', compact('latestArticles', 'premiumArticles', 'heroArticles', 'miniArticles', 'catArticles', 'sideArticles'));
    }

    public function show($slug)
    {
        $article = Article::with('author', 'category')->where('slug', $slug)->first();
        $latestArticles = Article::latest()->take(5)->get();

        return view('homepage.show', compact('article', 'latestArticles'));
    }

    public function category($slug)
    {        
        $category = Category::where('slug', $slug)->firstOrFail();

        $allCategories = Category::orderBy('name')->get();

        $articles = Article::with('author', 'category')->where('status', 'published')
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(10);

        return view('homepage.category', compact('category', 'allCategories', 'articles'));
    }
    
    public function tag($slug)
    {        
        // Ambil tag berdasarkan slug
        $tagItem = Tag::where('slug', $slug)->firstOrFail();

        // Ambil semua tag untuk sidebar/filter
        $allTag = Tag::orderBy('name')->get();

        // Ambil artikel yang punya relasi dengan tag ini
        $articles = Article::with(['author', 'tags'])
            ->where('status', 'published')
            ->whereHas('tags', function ($query) use ($tagItem) {
                $query->where('tags.id', $tagItem->id);
            })
            ->latest()
            ->paginate(10);

        return view('homepage.tag', compact('tagItem', 'allTag', 'articles'));
    }


    public function search(Request $request)
    {
        $query = $request->input('q');

        $articles = Article::with('author', 'category')->where('status', 'published')
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('body', 'like', '%' . $query . '%');
            })
            ->latest()
            ->paginate(6);
        $latestArticles = Article::where('status', 'published')->latest()->take(5)->get();

        return view('homepage.search', compact('articles', 'query', 'latestArticles'));
    }

}
