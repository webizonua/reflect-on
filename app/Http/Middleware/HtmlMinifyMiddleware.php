<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HtmlMinifyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof \Illuminate\Http\Response &&
            str_contains($response->headers->get('Content-Type'), 'text/html')) {

            $output = $response->getContent();

            $output = preg_replace('/>\s+</', '><', $output);
            $output = preg_replace('/\s+/', ' ', $output);
            $output = trim($output);

            $response->setContent($output);
        }

        return $response;
    }
}
