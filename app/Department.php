<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'remark', 'hod'
    ];

    public function people()
    {
        return $this->hasMany('App\Person');
    }    
}
