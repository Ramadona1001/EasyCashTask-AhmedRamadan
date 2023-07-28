<?php

namespace App\FilterResult;
use Closure;

class StatusCode
{
    // This Function using for filtering by status code
    public function handle($request , Closure $next)
    {
        $data = $next($request);
        if (!request()->has('statusCode')) {
            return $data;
        }else{
            $needles = ['status','transactionStatus'];
            if (request('statusCode') == 'paid') {
                return searchProviders($data,$needles,['done',1,100]);
            }elseif (request('statusCode') == 'pending') {
                return searchProviders($data,$needles,['wait',2,200]);
            }elseif (request('statusCode') == 'reject') {
                return searchProviders($data,$needles,['nope',3,300]);
            }
        }
    }
}
