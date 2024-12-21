<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveMaster extends Model
{
    use HasFactory;

    protected $table = 'leaveMaster';

    protected $fillable = ['leaveType'];

    public function leaveBalances()
    {
        return $this->hasMany(Leavebalance::class, 'leavetype');
    }

    public function employeeLeaveRecord()
    {
        return $this->hasMany(Leavebalance::class, 'leavetype');
    }
}
