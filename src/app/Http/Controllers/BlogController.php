<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $query = BlogPost::published()
            ->with(['category', 'author'])
            ->latest('published_at');

        if ($request->filled('kategori')) {
            $query->where('blog_category_id', $request->kategori);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('title', 'like', "%{$q}%")
                    ->orWhere('excerpt', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            });
        }

        $posts = $query->paginate(12)->withQueryString();
        $categories = BlogCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(string $slug): View
    {
        $post = BlogPost::published()
            ->where('slug', $slug)
            ->with(['category', 'author'])
            ->firstOrFail();

        $post->increment('view_count');

        return view('blog.show', compact('post'));
    }

    public function category(string $slug): View
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();

        $posts = BlogPost::published()
            ->where('blog_category_id', $category->id)
            ->with(['category', 'author'])
            ->latest('published_at')
            ->paginate(12);

        $categories = BlogCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('blog.index', [
            'posts' => $posts,
            'categories' => $categories,
            'currentCategory' => $category,
        ]);
    }
}
