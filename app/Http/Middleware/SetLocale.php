<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', 'hy');

        if (! in_array($locale, ['hy', 'ru', 'en'])) {
            $locale = 'hy';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
