<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function includes(string $relationship) :bool
    {
        $params = request()->get('include');

        if (!isset($params)) {
            return false;
        }

        $includedVariables = explode(',', strtolower($params));

        return in_array(strtolower($relationship), $includedVariables);
    }
}
