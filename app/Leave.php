<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'total_paidleave', 'total_paidsickleave', 'total_paidhospleave',
        'person_id'
    ];

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function applyleave()
    {
        return $this->hasOne('App\ApplyLeave');
    }       

    public function getTotalPaidleaveAttribute($value)
    {
        return $value + 0;
    } 

    public function getTotalPaidsickleaveAttribute($value)
    {
        return $value + 0;
    } 

    public function getTotalPaidhospleaveAttribute($value)
    {
        return $value + 0;
    }                
}
