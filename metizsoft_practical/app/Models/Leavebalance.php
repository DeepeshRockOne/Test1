<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leavebalance extends Model
{
    use HasFactory;

    protected $table = 'leavebalance';

    protected $fillable = ['leavetype', 'employeecode', 'leavebalance'];

    public function leaveType()
    {
        return $this->belongsTo(LeaveMaster::class, 'leavetype');
    }

    public function employees()
    {
        return $this->belongsToMany(EmployeeMaster::class, 'employeecode');
    }
}
