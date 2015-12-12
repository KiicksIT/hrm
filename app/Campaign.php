<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Campaign extends Model
{
    protected $fillable=[
        'name', 'start_date', 'end_date', 'invest', 'return', 'status', 'remark'
    ];

    protected $dates=['start_date', 'end_date'];

    public function setStartDateAttribute($date)
    {
        $this->attributes['start_date'] = Carbon::parse($date);
        //Carbon::createFromFormat('d-F-Y', $date);
    }

    public function setEndDateAttribute($date)
    {
        $this->attributes['end_date'] = Carbon::parse($date);
    }

    public function getStartDateAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }

    public function getEndDateAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }

    /**
     * search like name
     * @param $status in string
     * @return mixed
     */
    public function scopeSearchStatus($query, $status)
    {
        return $query->where('status', "$status");
    }
}
