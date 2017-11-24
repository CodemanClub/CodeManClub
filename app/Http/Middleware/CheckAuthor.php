<?php

namespace App\Http\Middleware;

use App\Article;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user())
            return redirect('/user/login');
        $article = Article::find($request->input('id'));
        if (Auth::id()!=$article->post_man_id) {
            return redirect('notAuthor');
        }
        return $next($request);
    }
}
