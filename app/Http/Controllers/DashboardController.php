<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Chat;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'usersCount'     => User::count(),
            'articlesCount'  => Article::count(),
            'categoriesCount'=> Category::count(),
            'tagsCount'      => Tag::count(),            
            'totalChats' => Chat::count(),
            'totalAIChats' => Chat::where('role', 'ai')->count(),
            'totalExpertChats' => Chat::where('role', 'expert')->count(),
            'totalUserChats' => Chat::where('role', 'user')->count(),
            'latestUsers'    => User::latest()->take(5)->get(),
            'latestArticles' => Article::latest()->take(5)->get(),
            'categories'     => Category::withCount('articles')->get(),
        ]);
    }
    
    public function expert()
    {
        // Statistik ringkasan
        $totalChats = Chat::count();
        $totalAIChats = Chat::where('role', 'ai')->count();
        $totalExpertChats = Chat::where('role', 'expert')->count();
        $totalUserChats = Chat::where('role', 'user')->count();

        // Status AI chat untuk chart
        $aiStatusCounts = Chat::where('role', 'ai')
            ->selectRaw("status, COUNT(*) as count")
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $aiStatusCounts = array_merge([
            'auto' => 0,
            'need_review' => 0,
            'approved' => 0,
        ], $aiStatusCounts);

        // List AI chat terbaru
        $latestAIChats = Chat::where('role', 'ai')
            ->latest()
            ->take(5)
            ->with('case', 'user')
            ->get();

        return view('dashboard.expert', compact(
            'totalChats',
            'totalAIChats',
            'totalExpertChats',
            'totalUserChats',
            'aiStatusCounts',
            'latestAIChats'
        ));
    }
}
