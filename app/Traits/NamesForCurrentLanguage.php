<?php

namespace App\Traits;

trait NamesForCurrentLanguage {

    public static function getNamesInCurrentLanguage(){
        $currentLanguage = \App::getLocale();
        $columnName = ($currentLanguage == 'en') ? 'name' : "name_$currentLanguage";

        return static::select(\DB::raw("id, $columnName as name"))->get();
    }
}