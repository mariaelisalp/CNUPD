<?php

namespace App\Http\Controllers;
use App\Models\UserActionLog;
use Carbon\Carbon;

use Illuminate\Http\Request;

class UserActionLogController extends Controller
{
    public function index(Request $request){
        $filters = $request->input('filters', []);
        $period = $request->input('period', null);
        $now = Carbon::now();
        $startDate = $now->subDays($period);
        $logs = (new UserActionLog())->getAll($filters, $startDate, $now);

        $logs_details = UserActionLog::getDetails($logs);


        return view('admin.index_logs', ['logs' => $logs,
         'logs_details' => $logs_details,
         'selectedFilters' => $filters,
        'selectedPeriod' => $period]);
    
    }
}
