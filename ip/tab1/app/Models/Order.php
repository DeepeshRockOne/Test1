<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function getPriceAttribute($value) {
        return "$".$value;
    }

    public function setOrderDateAttribute($value) {
        $dt = date('Y-m-d', strtotime($value));
        
        $this->attributes['order_date'] = $dt;
    }
}
