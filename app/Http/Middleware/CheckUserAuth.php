<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Lấy ID người dùng đã xác thực
            $userId = Auth::id();
            // Bạn có thể gán ID vào request nếu cần
            $request->attributes->set('userId', $userId);
        }

        return $next($request);
    }
}
