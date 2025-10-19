<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author', 'category', 'tags')->latest()->get();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');
        return view('articles.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'body'        => 'required',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['author_id'] = Auth::id();
        $data['slug'] = Str::slug($request->title);
        $data['status'] = $request->status ?? 'draft';

        if ($request->hasFile('thumbnail')) {
            
            $image = $request->file('thumbnail');
            $imageName = date('YmdHi') . '_' . $image->getClientOriginalName();
            $image->storeAs('uploads/thumbnails', $imageName, 'public');
            
            $data['thumbnail'] = "thumbnails/".$imageName;
        }

        $article = Article::create($data);

        if ($request->has('tags')) {
            $article->tags()->sync($request->tags);
        }

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dibuat!');
    }

    public function edit($id)
    {
        $article = Article::with('tags')->findOrFail($id);
        $categories = Category::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');
        return view('articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'body'        => 'required',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['status'] = $request->status ?? 'draft';
        $article = Article::findOrFail($id);
        
        // update thumbnail
        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail && Storage::disk('public')->exists('uploads/'.$article->thumbnail)) {
                Storage::disk('public')->delete('uploads/'.$article->thumbnail);
            }
            
            $image = $request->file('thumbnail');
            $imageName = date('YmdHi') . '_' . $image->getClientOriginalName();
            $image->storeAs('uploads/thumbnails', $imageName, 'public');
            
            $data['thumbnail'] = "thumbnails/".$imageName;
        }

        preg_match_all('/src="([^"]+)"/i', $article->body, $oldMatches);
        $oldImages = $oldMatches[1] ?? [];

        preg_match_all('/src="([^"]+)"/i', $request->body, $newMatches);
        $newImages = $newMatches[1] ?? [];

        $deletedImages = array_diff($oldImages, $newImages);

        foreach ($deletedImages as $fileUrl) {
            $path = str_replace('/storage/', '', parse_url($fileUrl, PHP_URL_PATH));
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $article->update($data);

        if ($request->has('tags')) {
            $article->tags()->sync($request->tags);
        }

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if ($article->thumbnail && Storage::disk('public')->exists('uploads/'.$article->thumbnail)) {
            Storage::disk('public')->delete('uploads/'.$article->thumbnail);
        }

        preg_match_all('/src="([^"]+)"/i', $article->body, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $fileUrl) {
                $path = str_replace('/storage/', '', parse_url($fileUrl, PHP_URL_PATH));
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
