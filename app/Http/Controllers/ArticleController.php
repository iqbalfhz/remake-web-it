<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('categories')->whereNotNull('published_at')->where('published_at', '<=', now())->orderBy('published_at', 'desc');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('excerpt', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $articles = $query->paginate(6)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('articles.index', compact('articles', 'categories'));
    }

    public function show(Article $artikel)
    {
        abort_if(
            is_null($artikel->published_at) || $artikel->published_at->isFuture(),
            404
        );

        $artikel->load(['categories', 'tags', 'comments', 'user']);

        $related = Article::with('categories')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where('id', '!=', $artikel->id)
            ->whereHas('categories', function ($q) use ($artikel) {
                $q->whereIn('categories.id', $artikel->categories->pluck('id'));
            })
            ->take(3)
            ->get();

        return view('articles.show', compact('artikel', 'related'));
    }
}
