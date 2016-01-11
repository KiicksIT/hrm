<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ApplyLeave extends Model
{
    protected $table = 'applyleaves';

    protected $fillable = [
        'leave_type', 'leave_from', 'leave_to',
        'day_num', 'person_id', 'leaveremark',
        'handover_person', 'status', 'reason'
    ];

    protected $dates = [
        'leave_from', 'leave_to'
    ];

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function leave()
    {
        return $this->belongsTo('App\Leave');
    } 

    public function setLeaveFromAttribute($date)
    {
        $this->attributes['leave_from'] = Carbon::parse($date);
    }   

    public function setLeaveToAttribute($date)
    {
        $this->attributes['leave_to'] = Carbon::parse($date);
    }

    public function getLeaveFromAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }

    public function getLeaveToAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    } 

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d/m/Y');
    }     

    public function getLeaveTypeAttribute($choice)
    {
        switch($choice){
            case 1: 
                return 'Paid Leave';
                break;

            case 2:
                return 'Paid Sick Leave';
                break;

            case 3:
                return 'Paid Hospitalisation Leave';
                break;

            case 4:
                return 'Unpaid Leave';
                break;
        }   
    }

    public function getDayNumAttribute($number)
    {
        return $number + 0;
    }                             

}
