<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArticleRequest;
use App\Http\Requests\Admin\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $this->authorize('artikel.view');

        $articles = Article::withCount('comments')->with('categories', 'tags', 'user')->latest()->paginate(15);

        return view('admin.artikel.index', compact('articles'));
    }

    public function create(): View
    {
        $this->authorize('artikel.create');

        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.artikel.create', compact('categories', 'tags'));
    }

    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $this->authorize('artikel.create');
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug(Str::slug($data['title']));
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article = Article::create($data);
        $article->categories()->sync($request->input('categories', []));
        $article->tags()->sync($this->resolveTagIds($request->input('tags', [])));

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $artikel): View
    {
        $this->authorize('artikel.edit');

        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $artikel->load('categories', 'tags');

        return view('admin.artikel.edit', compact('artikel', 'categories', 'tags'));
    }

    public function update(UpdateArticleRequest $request, Article $artikel): RedirectResponse
    {
        $this->authorize('artikel.edit');
        $data = $request->validated();

        if (isset($data['title'])) {
            $newSlug = Str::slug($data['title']);
            $data['slug'] = $newSlug === $artikel->slug
                ? $artikel->slug
                : $this->uniqueSlug($newSlug, $artikel->id);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        } else {
            unset($data['image']);
        }

        $artikel->update($data);
        $artikel->categories()->sync($request->input('categories', []));
        $artikel->tags()->sync($this->resolveTagIds($request->input('tags', [])));

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $artikel): RedirectResponse
    {
        $this->authorize('artikel.delete');
        $artikel->delete();

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    /**
     * Handle inline image uploads from the Quill editor.
     */
    public function uploadImage(Request $request): JsonResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096'],
        ]);

        $path = $request->file('image')->store('articles/inline', 'public');

        return response()->json(['url' => asset('storage/'.$path)]);
    }

    /**
     * Resolve tag names to Tag IDs, creating new tags on the fly.
     *
     * @param  array<string>  $tagNames
     * @return array<int>
     */
    private function resolveTagIds(array $tagNames): array
    {
        return collect($tagNames)
            ->filter()
            ->map(fn (string $name) => Tag::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => trim($name)]
            )->id)
            ->toArray();
    }

    /**
     * Generate a unique slug, appending -2, -3, etc. if needed.
     */
    private function uniqueSlug(string $slug, ?int $excludeId = null): string
    {
        $original = $slug;
        $count = 2;

        while (Article::where('slug', $slug)->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))->exists()) {
            $slug = "{$original}-{$count}";
            $count++;
        }

        return $slug;
    }
}
