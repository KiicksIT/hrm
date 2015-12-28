<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable=[
        'name', 'remark', 'work_hour',
        'work_off', 'work_day', 'prob_length'
    ];

    public function people()
    {
        return $this->hasMany('App\Person');
    }    

}
