<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $admin;

    public function __construct(Guard $admin)
    {
        $this->admin = $admin;
    }

    public function handle($request, Closure $next)
    {
        if($this->admin->guest())
        {
            return redirect('login');
        }
        elseif ($request->admin->user()->level !='admin')
        {
            return redirect('login');
        }
        return $next($request);
    }
}
