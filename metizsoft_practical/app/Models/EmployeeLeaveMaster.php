<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveMaster extends Model
{
    use HasFactory;

    protected $table = 'employee_leave_master';

    protected $fillable = [
        'leavetype', 'employeecode', 'fromdate', 'todate', 'numberofDays', 'comment'
    ];

    public function leaveType()
    {
        return $this->belongsTo(LeaveMaster::class, 'leavetype');
    }

    public function employee()
    {
        return $this->belongsTo(EmployeeMaster::class, 'employeecode');
    }
}
