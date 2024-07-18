<?php

namespace App\Http\Controllers;
use App\Models\UserActionLog;

use Illuminate\Http\Request;

class UserActionLogController extends Controller
{
    public function index(Request $request){
        $filters = $request->input('filters', []);
        $logs = (new UserActionLog())->getAll($filters);

        $logs_details = UserActionLog::getDetails($logs);


        return view('admin.index_logs', ['logs' => $logs,
         'logs_details' => $logs_details,'selectedFilters' => $filters,]);
    }
}
