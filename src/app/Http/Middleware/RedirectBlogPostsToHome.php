<?php

namespace App\Http\Middleware;

use App\Models\BlogPost;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectBlogPostsToHome
{
    public function handle(Request $request, Closure $next): Response
    {
        if (str_starts_with($request->path(), 'dashboard/blog-posts')) {
            return redirect('/');
        }

        if (str_starts_with($request->path(), 'post/')) {
            $slug = substr($request->path(), 5); // "post/" = 5 chars
            if (BlogPost::where('slug', $slug)->where('redirect_to_home', true)->exists()) {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
