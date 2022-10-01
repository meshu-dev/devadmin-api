<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getResponse(
        $params,
        int $statusCode = 200,
        array $headers = []
    ) {
        if (isset($this->resource) === true) {
            $response = (new $this->resource($params))->response();
        } else {
            $response = response()->json($params, $statusCode);
        }

        if (empty($headers) === false) {
            $response->withHeaders($headers);
        }
        return $response;
    }
}
