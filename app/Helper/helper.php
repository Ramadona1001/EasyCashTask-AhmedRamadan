<?php
use Illuminate\Support\Facades\File;

// Read Providers From Json Files

function readJsonFile($name){
    $path = app()->basePath('public/json/'.$name.'.json');
    $json = json_decode(File::get($path),true);
    $json['provider'] = $name;
    return $json;
}

/*
    $providers => Array of Provider
    $needles   => Array of Needle Do You Want To Search By Them ex: status,statusCode,...
    $values    => Array of Results' Values ex 1,100,2,200,...
*/
function searchProviders($providers , $needles , $values,$is_number = null,$min = null,$max=null)
{
    $output = [];
    foreach ($providers as $provider) {
        foreach ($provider as $key => $value) {
            if (in_array($key,$needles)) {
                if (is_array($values)) {
                    if (in_array($value,$values)) {
                        array_push($output,$provider);
                    }
                }else{
                    if ($is_number == null) {
                        if (strtolower($value) == strtolower($values)) {
                            array_push($output,$provider);
                        } 
                    }else{
                        if ($min == null && $max != null) {
                            if ($value <= $values) {
                                array_push($output,$provider);
                            }
                        }
                        if ($min != null && $max == null) {
                            if ($value >= $values) {
                                array_push($output,$provider);
                            }
                        }
                    }

                    
                }
            }
        }
    }
    return $output;
}