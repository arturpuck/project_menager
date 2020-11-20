<?php

namespace App\Helpers;

Class Company{
    
    public static function getYearsRange():array{
        $currentYear = Date('Y');
        $years = [];

        for($i = 2014 ; $i <= $currentYear; ++$i){
           $years[] = $i;
        }

        return $years;
    }
}