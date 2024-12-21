<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeMaster;
use Illuminate\Support\Facades\DB;

class LeaveReportController extends Controller
{
    public function leaveReport()
    {
        $report = EmployeeMaster::select('employee_master.id', 'employee_master.first_name', 'employee_master.last_name',
            DB::raw('(SELECT COUNT(*) FROM employee_leave_master WHERE employee_leave_master.employeecode = employee_master.id) as total_leaves'),
            DB::raw('(SELECT SUM(numberofDays) FROM employee_leave_master WHERE employee_leave_master.employeecode = employee_master.id) as total_leave_days'),
            DB::raw('(SELECT SUM(leavebalance) FROM leavebalance WHERE leavebalance.employeecode = employee_master.id) as total_leave_balance'))
            ->get();

        return view('leave_report', compact('report'));
    }
}
