<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplyLeave extends Model
{
    protected $table = 'applyleaves';

    protected $fillable = [
        'leave_type', 'leave_from', 'leave_to',
        'day_num', 'person_id', 'leave_id'
    ];

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function leave()
    {
        return $this->belongsTo('App\Leave');
    }    

}
