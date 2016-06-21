<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     * format ajax return json data
     * @param int $code
     * @param array $data
     * @param string $msg
     * @return \Illuminate\Http\JsonResponse
     */
    public function renderJson($code = 200, $data = [], $msg = '')
    {
        $ret = [
            'status'    => $code,
            'data'      => empty($data) ? null : $data,
            'msg'       => $msg
        ];
        return response()->json($ret);
    }
}
