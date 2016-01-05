<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $fillable = [
        'deduct_amount', 'deductitem_id', 'payslip_id'
    ]; 

    public function deductitem()
    {
        return $this->belongsTo('App\DeductItem');
    }

    public function payslip()
    {
        return $this->belongsTo('App\Payslip');
    }        
}
