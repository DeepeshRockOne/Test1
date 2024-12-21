<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeMaster extends Model
{
    use HasFactory;

    protected $table = 'employee_master';

    protected $fillable = [
        'employee_name', 'employee_code', 'first_name', 'last_name', 'username', 'email', 'phone', 'password', 'address', 'country_id', 'state_id', 'city_id', 'zip'
    ];

    protected $hidden = [
        'password'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function leaveRecords()
    {
        return $this->hasMany(EmployeeLeaveMaster::class, 'employeecode');
    }

    public function leaveBalance()
    {
        return $this->hasMany(Leavebalance::class, 'employeecode');
    }
}
