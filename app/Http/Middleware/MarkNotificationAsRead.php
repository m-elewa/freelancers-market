<?php

namespace App\Http\Middleware;

use Closure;

class MarkNotificationAsRead
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
        if($request->has('read')) {
            $notification = $request->user()->unreadNotifications->where('id', $request->read)->first();
            if($notification) {
                $notification->markAsRead();
            }
        }
        return $next($request);
    }
}
