<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function index(): View
    {
        $this->authorize('komentar.view');

        Comment::where('is_read', false)->update(['is_read' => true]);

        $comments = Comment::with('article')->latest()->paginate(20);

        return view('admin.komentar.index', compact('comments'));
    }

    public function destroy(Comment $komentar): RedirectResponse
    {
        $this->authorize('komentar.delete');

        $komentar->delete();

        return redirect()->route('admin.komentar.index')
            ->with('success', 'Komentar berhasil dihapus.');
    }
}
