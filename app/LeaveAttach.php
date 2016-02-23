<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LeaveAttach extends Model
{
    protected $table = 'leaveattach_person';

    protected $fillable = [
        'person_id', 'path', 'remark'
    ];
    
    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d-M-Y');
    }        

    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
