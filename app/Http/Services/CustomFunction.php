<?php

namespace App\Http\Services;

class CustomFunction
{   


    function sortArray($key, $sortType)
    {
        return function ($a, $b) use ($key, $sortType) {
            $t1 = strtotime($a->$key);
            $t2 = strtotime($b->$key);

            if ($sortType == 'asc') {
                return $t1-$t2;
            }
                
            return $t2-$t1;
        };
    }

    public function arrayToString($arrayData=[])
    {
        $string = '';
        $ctr=0;

        foreach ($arrayData as $data) {
            $ctr++;
            $string .= count($arrayData) > $ctr ? '"'.$data.'", ' : '"'.$data.'"';
        }

        return $string;
    }

    public function stringToArray($seperator, $string)
    {
        if ($string == null) {
            return [];
        }

        $array = explode($seperator, str_replace('"', '', $string));
        return $array;
    }

    public function letterChoices()
    {
        return ['A', 'B', 'C', 'D', 'E', 'F'];
    }

}
