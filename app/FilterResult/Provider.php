<?php

namespace App\FilterResult;
use Closure;

class Provider
{
    // This Function using for filtering by provider
    public function handle($request , Closure $next)
    {
        $data = $next($request);
        $providers = [];
        if (!request()->has('provider')) {
            return $data;
        }
        $needles = ['provider'];
        return searchProviders($data,$needles,request('provider'));
    }
}
