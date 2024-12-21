<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveMaster;
use App\Models\Leavebalance;
use App\Models\EmployeeMaster;
use App\Models\EmployeeLeaveMaster;
use App\Models\Noneworkingday;
use Carbon\Carbon;

class LeaveController extends Controller
{
    public function showLeaveForm()
    {
        $leaveTypes = LeaveMaster::all();
        $employee = $this->getAuthenticatedEmployee();
        
        return view('leave_request', compact('leaveTypes','employee'));
    }

    public function submitLeaveRequest(Request $request)
    {
        $employeeId = session('employee_id');

        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'leavetype' => 'required|exists:leavemaster,id',
            'comment' => 'required|string|max:300',
        ]);

        //$employeeCode = $request->employee_code;
        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date);
        $leaveTypeId = $request->leavetype;

        $existingLeave = EmployeeLeaveMaster::where('employeecode', $employeeId)
                                     ->where(function ($query) use ($fromDate, $toDate) {
                                         $query->whereBetween('fromdate', [$fromDate, $toDate])
                                               ->orWhereBetween('todate', [$fromDate, $toDate]);
                                     })
                                     ->exists();

        if ($existingLeave) {
            $existingLeaveDates = EmployeeLeaveMaster::where('employeecode', $employeeId)
                                     ->where(function ($query) use ($fromDate, $toDate) {
                                         $query->whereBetween('fromdate', [$fromDate, $toDate])
                                               ->orWhereBetween('todate', [$fromDate, $toDate]);
                                     })
                                     ->first();

            return redirect()->route('leave.form')->with('fail', 'Leave already applied for ' .$existingLeaveDates->fromdate. ' -> ' .$existingLeaveDates->todate. ', which is in between or exact selected date range.');
        }

        $totalLeaveDays = $this->calculateWorkingDays($fromDate, $toDate);

        $leaveBalance = Leavebalance::where('employeecode', $employeeId)
                                            ->where('leavetype', $leaveTypeId)
                                            ->first();

        if (!$leaveBalance || $leaveBalance->leavebalance < $totalLeaveDays) {
            return redirect()->route('leave.form')->with('fail', 'Insufficient leave balance for the selected leave type.');
        }

        $leaveBalance->leavebalance -= $totalLeaveDays;
        $leaveBalance->save();

        EmployeeLeaveMaster::create([
            'leavetype' => $leaveTypeId,
            'employeecode' => $employeeId,
            'fromdate' => $request->from_date,
            'todate' => $request->to_date,
            'numberofDays' => $totalLeaveDays,
            'comment' => $request->comment,
        ]);

        return redirect()->route('leave.list')->with('success', 'Leave request submitted successfully.');
    }

    public function listLeaves()
    {
        $employee = $this->getAuthenticatedEmployee();

        $employee = EmployeeMaster::with(['leaveRecords', 'leaveBalance'])->find($employee->id);

        $leaveRecordsWithBalance = $employee->leaveRecords->map(function ($record) use ($employee) {
            $leaveBalance = $employee->leaveBalance->firstWhere('leavetype', $record->leavetype);
            $leaveType = LeaveMaster::firstWhere('id', $record->leavetype);
            $record->leavetype = $leaveType->leaveType ?? '';
            $record->leave_balance = $leaveBalance ? $leaveBalance->leavebalance : 0;
            return $record;
        });

        return view('leave_list', compact('employee', 'leaveRecordsWithBalance'));

        //return view('leave_list', compact('employee', 'leaveRequests', 'leaveBalances'));
    }

    public function editLeave($id)
    {
        $leaveRequest = EmployeeLeaveMaster::findOrFail($id);
        $leaveTypes = LeaveMaster::all();
        $employeeCode = $leaveRequest->employee->employee_code;

        return view('edit_leave', compact('leaveRequest', 'leaveTypes', 'employeeCode'));
    }

    public function updateLeave(Request $request, $id)
    {
        $employeeId = session('employee_id');

        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'leavetype' => 'required|exists:leavemaster,id',
            'comment' => 'required|string|max:300',
        ]);

        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date);
        $leaveTypeId = $request->leavetype;

        $existingLeave = EmployeeLeaveMaster::where('employeecode', $employeeId)
                                     ->where('id', '!=', $id)
                                     ->where(function ($query) use ($fromDate, $toDate) {
                                         $query->whereBetween('fromdate', [$fromDate, $toDate])
                                               ->orWhereBetween('todate', [$fromDate, $toDate]);
                                     })
                                     ->exists();

        if ($existingLeave) {
            $existingLeaveDates = EmployeeLeaveMaster::where('employeecode', $employeeId)
                                     ->where('id', '!=', $id)
                                     ->where(function ($query) use ($fromDate, $toDate) {
                                         $query->whereBetween('fromdate', [$fromDate, $toDate])
                                               ->orWhereBetween('todate', [$fromDate, $toDate]);
                                     })
                                     ->first();

            return redirect()->route('leave.form')->with('fail', 'Leave already applied for ' .$existingLeaveDates->fromdate. ' -> ' .$existingLeaveDates->todate. ', which is in between or exact selected date range.');
        }

        $OldleaveRequest = EmployeeLeaveMaster::findOrFail($id);

        if ($OldleaveRequest->fromdate != $request->from_date || $OldleaveRequest->todate != $request->to_date) {
            $totalLeaveDays = $this->calculateWorkingDays($fromDate, $toDate);

            $leaveBalance = Leavebalance::where('employeecode', $employeeId)
                                                ->where('leavetype', $leaveTypeId)
                                                ->first();

            if (!$leaveBalance || $leaveBalance->leavebalance < $totalLeaveDays) {
                return redirect()->route('leave.form')->with('fail', 'Insufficient leave balance for the selected leave type.');
            }

            $leaveBalance->leavebalance = $leaveBalance->leavebalance - $totalLeaveDays;
            $leaveBalance->save();

            $OldleaveRequest->update([
                'employeecode' => $employeeId,
                'fromdate' => $request->from_date,
                'todate' => $request->to_date,
                'numberofDays' => $totalLeaveDays,
                'comment' => $request->comment,
            ]);
        }

        if($OldleaveRequest) {
            $OldleaveRequest->update([
                'employeecode' => $employeeId,
                'comment' => $request->comment,
            ]);
        }

        return redirect()->route('leave.list')->with('success', 'Leave request updated successfully.');
    }

    public function deleteLeave($id)
    {
        $leaveRequest = EmployeeLeaveMaster::findOrFail($id);
        $employeeId = $leaveRequest->employeecode;
        $leaveTypeId = $leaveRequest->leavetype;
        $numberofDays = $leaveRequest->numberofDays;

        $leaveBalance = Leavebalance::where('employeecode', $employeeId)
                                            ->where('leavetype', $leaveTypeId)
                                            ->first();

        if (!$leaveBalance) {
            return redirect()->route('leave.list')->with('fail', 'No record found for delete.');
        }

        $leaveBalance->leavebalance += $numberofDays;
        $leaveBalance->save();

        $leaveRequest->delete();

        return redirect()->route('leave.list')->with('success', 'Leave request deleted successfully.');
    }

    private function getAuthenticatedEmployee()
    {
        $employeeId = session('employee_id');

        if (!$employeeId) {
            abort(403, 'Unauthorized action.');
        }

        return EmployeeMaster::findOrFail($employeeId);
    }

    private function calculateWorkingDays($fromDate, $toDate)
    {
        $totalDays = 0;

        $nonWorkingDays = Noneworkingday::whereBetween('date', [$fromDate, $toDate])->pluck('date')->toArray();

        while ($fromDate <= $toDate) {
            if ($fromDate->isWeekday() && !in_array($fromDate->toDateString(), $nonWorkingDays)) {
                $totalDays++;
            }
            $fromDate->addDay();
        }

        return $totalDays;
    }
}
