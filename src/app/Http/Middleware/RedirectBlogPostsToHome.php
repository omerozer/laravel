<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class RedirectBlogPostsToHome
{
    public function handle(Request $request, Closure $next): Response
    {
        if (str_starts_with($request->path(), 'dashboard/blog-posts')) {
            return redirect('/');
        }

        if (str_starts_with($request->path(), 'post/')) {
            $slug = substr($request->path(), 5);
            $redirectSlugs = Config::get('redirect_posts.slugs', []);
            if (in_array($slug, $redirectSlugs, true)) {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
