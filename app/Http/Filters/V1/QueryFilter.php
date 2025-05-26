<?php

namespace App\Http\Filters\V1;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter 
{
    protected $builder;

    public function __construct(protected Request $request)
    {
        //
    }

    protected function filter($arr) {
        foreach($arr as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }
        return $this->builder;
    }

    public function applyFilters(Builder $builder) {
        $this->builder = $builder;

        foreach($this->request->all() as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }

        return $builder;
    }
}