<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addother extends Model
{
    protected $fillable = [
        'addother_amount', 'addotheritem_id', 'payslip_id'
    ];

    public function addotheritem()
    {
        return $this->belongsTo('App\Addotheritem');
    }

    public function payslip()
    {
        return $this->belongsTo('App\Payslip');
    } 
}
