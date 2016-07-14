<?php

namespace App\Http\Middleware;

use Closure;

class BaseMiddelware
{
    public $userId;
    public $user;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $userId = $request->session()->get('user_id', 0);
//        if ($userId > 0) {
//            $this->userId = $userId;
//            $user = User::find($userId);
//            !empty($user) && $this->user = $user->toArray();
//        }
//
//        if (!empty($this->user)) {
//            return $next($request);
//        } else {
//            return redirect('/login');
//        }
    }
}
