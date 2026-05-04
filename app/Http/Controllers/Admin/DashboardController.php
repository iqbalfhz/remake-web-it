<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\MailingList;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Stat counts
        $totalArticles = Article::count();
        $publishedArticles = Article::whereNotNull('published_at')->where('published_at', '<=', now())->count();
        $draftArticles = $totalArticles - $publishedArticles;

        $totalCategories = Category::count();

        $totalComments = Comment::count();
        $unreadComments = Comment::where('is_read', false)->count();

        $totalContacts = Contact::count();
        $unreadContacts = Contact::where('is_read', false)->count();

        $totalUsers = User::count();
        $pendingUsers = User::where('is_approved', false)->count();
        $activeUsers = User::where('is_active', true)->count();

        $totalMailingList = MailingList::count();

        // Recent data
        $recentArticles = Article::with('user')->latest()->limit(5)->get();
        $recentComments = Comment::with('article')->latest()->limit(5)->get();
        $recentContacts = Contact::latest()->limit(5)->get();
        $newUsers = User::where('is_approved', false)->latest()->limit(5)->get();

        // Build chart data for multiple ranges: 3, 6, 12 months
        $chartRanges = [3, 6, 12];

        $articleCharts = [];
        $commentCharts = [];
        $userCharts = [];

        foreach ($chartRanges as $months) {
            $articleCharts[$months] = collect(range($months - 1, 0))->map(function (int $monthsAgo) {
                $date = now()->subMonths($monthsAgo);

                return [
                    'label' => $date->translatedFormat('M Y'),
                    'count' => Article::whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->count(),
                ];
            });

            $commentCharts[$months] = collect(range($months - 1, 0))->map(function (int $monthsAgo) {
                $date = now()->subMonths($monthsAgo);

                return [
                    'label' => $date->translatedFormat('M Y'),
                    'count' => Comment::whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->count(),
                ];
            });

            $userCharts[$months] = collect(range($months - 1, 0))->map(function (int $monthsAgo) {
                $date = now()->subMonths($monthsAgo);

                return [
                    'label' => $date->translatedFormat('M Y'),
                    'count' => User::whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->count(),
                ];
            });
        }

        // Category distribution (articles per category)
        $categoryChart = Category::withCount('articles')
            ->orderByDesc('articles_count')
            ->limit(8)
            ->get()
            ->map(fn ($cat) => [
                'label' => $cat->name,
                'count' => $cat->articles_count,
            ]);

        // Growth: compare this month vs last month
        $articlesThisMonth = Article::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)->count();
        $articlesLastMonth = Article::whereYear('created_at', now()->subMonth()->year)
            ->whereMonth('created_at', now()->subMonth()->month)->count();

        $commentsThisMonth = Comment::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)->count();
        $commentsLastMonth = Comment::whereYear('created_at', now()->subMonth()->year)
            ->whereMonth('created_at', now()->subMonth()->month)->count();

        $usersThisMonth = User::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)->count();
        $usersLastMonth = User::whereYear('created_at', now()->subMonth()->year)
            ->whereMonth('created_at', now()->subMonth()->month)->count();

        return view('admin.dashboard', compact(
            'totalArticles',
            'publishedArticles',
            'draftArticles',
            'totalCategories',
            'totalComments',
            'unreadComments',
            'totalContacts',
            'unreadContacts',
            'totalUsers',
            'pendingUsers',
            'activeUsers',
            'totalMailingList',
            'recentArticles',
            'recentComments',
            'recentContacts',
            'newUsers',
            'articleCharts',
            'commentCharts',
            'userCharts',
            'categoryChart',
            'articlesThisMonth',
            'articlesLastMonth',
            'commentsThisMonth',
            'commentsLastMonth',
            'usersThisMonth',
            'usersLastMonth',
        ));
    }
}
