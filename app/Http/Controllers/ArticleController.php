<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::whereNotNull('published_at')->orderBy('published_at', 'desc');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%')
                ->orWhere('excerpt', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $articles = $query->paginate(6)->withQueryString();
        $categories = Article::whereNotNull('published_at')->distinct()->pluck('category');

        return view('articles.index', compact('articles', 'categories'));
    }

    public function show(Article $article)
    {
        $related = Article::whereNotNull('published_at')
            ->where('id', '!=', $article->id)
            ->where('category', $article->category)
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'related'));
    }
}
