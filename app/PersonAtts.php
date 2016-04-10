<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonAtts extends Model
{
    protected $table = 'personatts';

    protected $fillable = [
        'basic', 'basic_rate', 'ot_rate',
        'resident', 'total_earned', 'paid_leave',
        'mc', 'hospital_leave', 'other_leave',
        'benefit_remark', 'person_id',
    ];

    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
