<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Helpers\PluckColumnBy;

Class NameAttribute implements CastsAttributes{

    public function get($model, $key, $value, $attributes)
    {
        $columnName = PluckColumnBy::get();
        return $model->$columnName;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}