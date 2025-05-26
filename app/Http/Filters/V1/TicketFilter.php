<?php

namespace App\Http\Filters\V1;

class TicketFilter extends QueryFilter
{

    public function include($value) {
        return $this->builder->with($value);
    }

    public function status($value) {
        $statusArray = explode(',', $value);
        return $this->builder->whereIn('status', $statusArray);
    }

    public function title($value) {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('title', 'like', $likeStr);
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