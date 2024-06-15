<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Lifter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCurrentLifterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lifterSlug = $request->route('lifterSlug');

        if (!$request->session()->has('lifter')) {
            return redirect()->route('onerepmax.step1');
        }

        if ($lifterSlug !== $request->session()->get('lifter')) {
            Lifter::where('slug', session()->get('lifter'))
                ->firstOrFail()
                ->delete();

            return redirect()->route('onerepmax.step1')->withErrors(['Erro de Autorização.']);
        }

        return $next($request);
    }
}
