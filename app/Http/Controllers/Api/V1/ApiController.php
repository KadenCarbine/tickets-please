<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use ApiResponses;

    protected $policyClass;

    public function __construct()
    {
        Gate::guessPolicyNamesUsing(function () {
            return $this->policyClass;
        });
    }

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
