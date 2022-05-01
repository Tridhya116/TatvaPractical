<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Blog;
class BlogAccessMiddleware
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
        $blog=Blog::where('id',$request->id)->first();
        if($blog->user_id != Auth::id())
        {
            return redirect()->route('blogs')->with('error','You dont have access to this route!');

        }
        return $next($request);
    }
}
