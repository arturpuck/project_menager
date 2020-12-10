<?php

namespace App\Traits;

use App\Helpers\PluckColumnBy;

trait NamesForCurrentLanguage {

    public function getNameInCurrentLanguageAttribute(){
        $columnName = PluckColumnBy::get();
        return $this->$columnName;
    }
}