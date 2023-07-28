<?php

namespace App\FilterResult;
use Closure;

class Currency
{
    // This Function using for filtering by currency
    public function handle($request , Closure $next)
    {
        $data = $next($request);
        if (!request()->has('currency')) {
            return $data;
        }else{
            $needles = ['currency','Currency'];
            return searchProviders($data,$needles,strtolower(request('currency')));
        }
    }
}
