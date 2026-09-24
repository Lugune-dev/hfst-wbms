<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    protected array $supported = ['en', 'sw', 'fr'];

    public function handle(Request $request, Closure $next): Response
    {
        $requestedLocale = $request->get('lang') ?: $request->get('locale');
        $locale = $requestedLocale 
            ?: session('locale') 
            ?: $request->cookie('hfst_locale') 
            ?: config('app.locale', 'en');

        if (!in_array($locale, $this->supported)) {
            $locale = 'en';
        }

        App::setLocale($locale);

        if (session('locale') !== $locale) {
            session(['locale' => $locale]);
        }

        if ($request->cookie('hfst_locale') !== $locale) {
            cookie()->queue(cookie()->forever('hfst_locale', $locale, '/', null, false, false));
        }

        return $next($request);
    }
}
