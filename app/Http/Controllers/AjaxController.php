<?php

namespace App\Http\Controllers;

use App\Models\ApacheLog;

class AjaxController extends Controller
{
    /**
     * Get log grouped by IP
     *
     * @param string $startDate Start date
     * @param string $endDate End date
     * @return \Illuminate\Http\JsonResponse
     */
    public function groupedByIpLog($startDate, $endDate)
    {
        $list = ApacheLog::groupByIp($startDate, $endDate);

        return response()->json($list);
    }

    /**
     * Get log grouped by date
     *
     * @param string $startDate Start date
     * @param string $endDate End date
     * @return \Illuminate\Http\JsonResponse
     */
    public function groupedByDateLog($startDate, $endDate)
    {
        $list = ApacheLog::groupByDate($startDate, $endDate);

        return response()->json($list);
    }
}
