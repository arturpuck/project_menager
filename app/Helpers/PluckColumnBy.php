<?php

namespace App\Helpers;

Class PluckColumnBy{

   public static function get():string{
       $currentLanguage = \App::getLocale();
       return ($currentLanguage == 'en') ? 'name' : 'name_'.$currentLanguage;
   }
}