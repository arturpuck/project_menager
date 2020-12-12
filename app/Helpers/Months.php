<?php

namespace App\Helpers;

Class Months{

    const names = [
     'pl' => ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 
        'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'] 
    ];

    public static function getNames():array{

        return self::names[\App::getLocale()];
    }

    public static function namesOfCurrentMonthAndPrevious():array{

          $currentMonth = intval(date('m'));
          $months = [];
          $months[] = ($currentMonth === 1) ? self::names[\App::getLocale()][11] : self::names[\App::getLocale()][$currentMonth - 2];
          $months[] = self::names[\App::getLocale()][$currentMonth - 1];
          return $months;
    }

    public static function parseMonthNumber(int $month):string{

        return ($month < 10) ? '0'.strval($month) : strval($month);
    }

    public static function numbersOfCurrentMonthAndPrevious():array{

          $currentMonth = intval(date('m'));
          $previousMonth = ($currentMonth === 1) ? 12 : $currentMonth - 1;
          $monthsNumbers = [];
          $monthsNumbers[] = self::parseMonthNumber($previousMonth);
          $monthsNumbers[] = self::parseMonthNumber($currentMonth);
          
          return $monthsNumbers;
    }

    public static function getAlMonthsParsedNumbers():array{
        return ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
    }
}