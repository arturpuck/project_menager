<?php

namespace App\Repositories;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;

Abstract Class BaseRepository{

    protected  $query;

    public function __construct(){
       $model = static::MODEL_NAME;
       $this->query = $model::query();
    }

    public function get(){
      return $this->query->get();
    }

    public function resetQuery(){
      $model = static::MODEL_NAME;
      $this->query = $model::query();
    }

    public function select(array $columnNames): self{
        
        foreach($columnNames as $columnName){
              $this->query = $this->query->addSelect($columnName);
        }
  
      return $this;
  }

  public function with(array $relations) : self{
    $this->query = $this->query->with($relations);
    return $this;
  }

  public function paginate(int $elementsPerPage = 100){
      $this->query->paginate($elementsPerPage);
  }
}