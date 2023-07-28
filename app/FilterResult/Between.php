<?php

namespace App\FilterResult;
use Closure;

class Between
{
    // This Function using for Searching amount between min and max
    public function handle($request , Closure $next)
    {
        $data = $next($request);

        if (!request()->has('amounteMin') && !request()->has('amounteMax')) {
            return $data;
        }else{
            $needles = ['amount','transactionAmount'];
            if (request()->has('amounteMin')) {
                return searchProviders($data,$needles,request('amounteMin'),1,1,null);
            }
            if (request()->has('amounteMax')) {
                return searchProviders($data,$needles,request('amounteMax'),1,null,1);
            }
            if (request()->has('amounteMin') && request()->has('amounteMax')) {
                return searchProviders($data,$needles,range(request('amounteMin'),request('amounteMax')));
            }
            
        }
    }
}
