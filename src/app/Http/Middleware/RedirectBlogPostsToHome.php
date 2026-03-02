<?php

namespace App\Http\Middleware;

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
            return redirect('/');
        }

        return $next($request);
    }
}
