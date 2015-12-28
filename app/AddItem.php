<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddItem extends Model
{
    protected $table = 'additems';

    protected $fillable = [
        'name'
    ];

    public function payslips()
    {
        return $this->belongsToMany('App\Payslip');
    }

    public function additions()
    {
        return $this->hasMany('App\Addition');
    }        
}
