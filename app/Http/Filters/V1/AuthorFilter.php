<?php

namespace App\Http\Filters\V1;

class AuthorFilter extends QueryFilter
{

    protected $sortable = [
        'name',
        'email',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at'
    ];

    public function include($value) {
        return $this->builder->with($value);
    }

    public function id($value) {
        $statusArray = explode(',', $value);
        return $this->builder->whereIn('id', $statusArray);
    }

    public function email($value) {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('email', 'like', $likeStr);
    }
    public function name($value) {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('name', 'like', $likeStr);
    }

    public function createdAt($value) {
        $datesArray = explode(',', $value);

        if(count($datesArray) > 1) {
            return $this->builder->whereBetween('created_at', $datesArray);
        }

        return $this->builder->whereDate('created_at', $value);
    }

    public function updatedAt($value) {
        $datesArray = explode(',', $value);

        if(count($datesArray) > 1) {
            return $this->builder->whereBetween('updated_at', $datesArray);
        }

        return $this->builder->whereDate('updated_at', $value);
    }
}