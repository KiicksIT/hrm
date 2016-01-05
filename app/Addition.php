<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
    protected $fillable = [
        'add_amount', 'additem_id', 'payslip_id'
    ];

    public function additem()
    {
        return $this->belongsTo('App\AddItem');
    }

    public function payslip()
    {
        return $this->belongsTo('App\Payslip');
    }    
}
