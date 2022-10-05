<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getResponse(
        $params,
        int $statusCode = 200,
        array $headers = []
    ) {
        $response = null;

        if (isset($this->resource) === true) {
            if ($params instanceof Model) {
                $response = (new $this->resource($params));
            } elseif ($params instanceof Collection) {
                $response = call_user_func($this->resource . '::collection', $params);
            }
        }

        if ($response === null) {
            $response = response()->json($params, $statusCode);
        }

        if (empty($headers) === false) {
            $response->withHeaders($headers);
        }

        return $response;
    }
}
