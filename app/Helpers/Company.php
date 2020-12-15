<?php

namespace App\Helpers;

Class Company{
    
    public static function getYearsRange():array{
        $currentMonth = Date('m');
        $currentYear = ($currentMonth > 9) ? (Date('Y') + 1) : Date('Y');
        $years = [];

        for($i = 2019 ; $i <= $currentYear; ++$i){
           $years[] = $i;
        }

        return $years;
    }
}