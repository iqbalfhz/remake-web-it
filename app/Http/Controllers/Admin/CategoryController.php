<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $this->authorize('kategori.view');

        $categories = Category::withCount('articles')->latest()->paginate(20);

        return view('admin.kategori.index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('kategori.create');
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name'],
        ]);

        $data['slug'] = Str::slug($data['name']);

        Category::create($data);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Category $kategori): RedirectResponse
    {
        $this->authorize('kategori.edit');

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name,'.$kategori->id],
        ]);

        $data['slug'] = Str::slug($data['name']);

        $kategori->update($data);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $kategori): RedirectResponse
    {
        $this->authorize('kategori.delete');

        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
