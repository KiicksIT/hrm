<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeductItem extends Model
{
    protected $table = 'deductitems';

    protected $fillable = [
        'name'
    ];

    public function payslips()
    {
        return $this->belongsToMany('App\Payslip');
    }

    public function deductions()
    {
        return $this->hasMany('App\Deduction');
    }  
}
