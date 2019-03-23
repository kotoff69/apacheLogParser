<?php

namespace App\Http\Controllers;

use App\Models\ApacheLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Types of group
     */
    const GROUP_IP = 'group_id';
    const GROUP_DATE = 'group_date';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Report page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function report(Request $request)
    {
        $list = [];

        if ($request->isMethod('post')) {
            $startDate = $request->post('start_date');
            $endDate = $request->post('end_date');

            if ($request->post('type') == self::GROUP_IP) {
                $list = ApacheLog::groupByIp($startDate, $endDate);
            } elseif ($request->post('type') == self::GROUP_DATE) {
                $list = ApacheLog::groupByDate($startDate, $endDate);
            }
        }

        return view('report.index', [
            'list' => $list,
            'request' => $request,
        ]);
    }
}
