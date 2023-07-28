<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use App\FilterResult\Provider;
use App\FilterResult\StatusCode;
use App\FilterResult\Between;
use App\FilterResult\Currency;

class TransactaionsController extends Controller
{
    public function index(Request $request)
    {

        /*
            if you want to add another service
            1- you should create file json in public/json/name_of_file.json
            2- add this file's name in providers array
        */

        //This Project using functions in helper file in (App/Helper/helper.php)

        //Providers Array
        $providers = [
            readJsonFile('DataProviderW'),
            readJsonFile('DataProviderX'),
            readJsonFile('DataProviderY'),
        ];

        /*
            Make Filtration of Provider (provider , status , min and max , currency)
            using laravel pipeline
        */
        $filter = app(Pipeline::class)
                  ->send($providers)
                  ->through([
                    Provider::class,
                    StatusCode::class,
                    Between::class,
                    Currency::class
                  ])->thenReturn();

        return $filter;
    }
}
