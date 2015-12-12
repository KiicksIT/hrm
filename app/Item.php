<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable=[
        'name', 'remark'
    ];

    public function transactions()
    {
        return $this->belongsToMany('App\Transaction');
    }   

    public function deals()
    {
        return $this->hasMany('App\Item');
    }    
      
}
