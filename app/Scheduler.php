<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Scheduler extends Model
{
    protected $fillable=[
        'name', 'remark', 'status', 'notify_date', 'appt_date'
    ];

    protected $dates = [
        'notify_date', 'appt_date'
    ];

    public function setNotifyDateAttribute($date)
    {
        $this->attributes['notify_date'] = Carbon::parse($date);
    }

    public function getNotifyDateAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }

    public function setApptDateAttribute($date)
    {
        $this->attributes['appt_date'] = Carbon::createFromFormat('d-F-Y H:i A', $date);
    }

    public function getApptDateAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y h:iA');
    }

    public function getEmailListAttribute()
    {
        return $this->users->lists('id')->all();
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
