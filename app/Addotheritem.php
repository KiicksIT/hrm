<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addotheritem extends Model
{
    protected $fillable = [
        'name'
    ];

    public function payslips()
    {
        return $this->belongsToMany('App\Payslip');
    }

    public function addothers()
    {
        return $this->hasMany('App\Addother');
    }  
}
