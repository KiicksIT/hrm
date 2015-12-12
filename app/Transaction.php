<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    protected $fillable=[
        'amount', 'contract_start', 'contract_end', 
        'person_id', 'transremark'
    ];

    public function setContractStartAttribute($date)
    {
        $this->attributes['contract_start'] = Carbon::parse($date);
    }

    public function setContractEndAttribute($date)
    {
        $this->attributes['contract_end'] = Carbon::parse($date);
    }

    public function setTransremarkAttribute($value)
    {
        $this->attributes['transremark'] = $value ?: null;
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function items()
    {
        return $this->belongsToMany('App\Item')->withTimestamps();
    }

 /*   public function user()
    {
        return $this->belongsTo('App\User')->withTimestamps();
    }*/

    public function market()
    {
        return $this->hasOne('App\Market');
    }

    public function getItemListAttribute()
    {
        return $this->items->lists('id')->all();
    }

    public function getContractStartAttribute($date)
    {
        return Carbon::parse($date)->format('d-M-Y');
    }

    public function getContractEndAttribute($date)
    {
        return Carbon::parse($date)->format('d-M-y');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d-M-y');
    }    

    /**
     * search and retrieve month data
     * @param $month in integer
     * @return mixed
     */
    public function scopeSearchDateRange($query, $datefrom, $dateto)
    {
        $datefrom = Carbon::createFromFormat('d-F-Y', $datefrom);

        $dateto = Carbon::createFromFormat('d-F-Y', $dateto);

        return $query->whereBetween('created_at',array($datefrom, $dateto));
    }

    public function scopeSearchYearRange($query, $year)
    {

        return $query->whereBetween('created_at', array(Carbon::parse('first day of January '.$year), Carbon::parse('last day of December '.$year)));

    }

    public function scopeSearchMonthRange($query, $month)
    {
        if($month != '0'){

            return $query->whereBetween('created_at', array(Carbon::create(Carbon::now()->year, $month)->startOfMonth(), Carbon::create(Carbon::now()->year, $month)->endOfMonth()));

        }else{

            return $query->whereBetween('created_at', array(Carbon::now()->startOfYear(), Carbon::now()->endOfYear()));

        }
    }    
}
