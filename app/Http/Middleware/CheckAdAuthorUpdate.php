<?php

namespace App\Http\Middleware;

use App\Ad;
use Closure;

class CheckAdAuthorUpdate
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
        if ($request->id !== null) {
            $ad = \App\Ad::find($request->id);

            if ($request->user()->cannot('update', $ad)) {
                return redirect()
                    ->route('home')
                    ->withErrors(['not allowed' => 'You cannot edit this ad.']);
            }
        }
        return $next($request);
    }
}
