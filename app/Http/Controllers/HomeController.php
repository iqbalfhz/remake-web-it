<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('home', compact('articles'));
    }

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Pesan berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}
