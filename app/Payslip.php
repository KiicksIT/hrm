<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payslip extends Model
{
    protected $fillable = [
        'person_id', 'basic', 'add_total',
        'deduct_total', 'pay_date', 'pay_mode',
        'ot_from', 'ot_to', 'ot_hour',
        'ot_total', 'other_total', 'net_pay',
        'employee_epf', 'status', 'payslip_from',
        'payslip_to', 'workday_actual', 'workday_total',
        'employercont_epf', 'cheque_no'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'pay_date', 'ot_from', 'ot_to',
        'payslip_from', 'payslip_to'
    ];

    // dates format
    public function getPayDateAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }

    public function getOtFromAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }

    public function getOtToAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }

    public function getPayslipFromAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }

    public function getPayslipToAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d-M-Y');
    }

    public function getWorkdayActualAttribute($value)
    {
        return $value + 0;
    }

    public function getWorkdayTotalAttribute($value)
    {
        return $value + 0;
    }

    public function getOtHourAttribute($value)
    {
        return $value + 0;
    }

    public function setPayDateAttribute($date)
    {
        $this->attributes['pay_date'] = Carbon::parse($date);
    }

    public function setOtFromAttribute($date)
    {
        $this->attributes['ot_from'] = Carbon::parse($date);
    }

    public function setOtToAttribute($date)
    {
        $this->attributes['ot_to'] = Carbon::parse($date);
    }

    public function setPayslipFromAttribute($date)
    {
        $this->attributes['payslip_from'] = Carbon::parse($date);
    }

    public function setPayslipToAttribute($date)
    {
        $this->attributes['payslip_to'] = Carbon::parse($date);
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function additions()
    {
        return $this->hasMany('App\Addition');
    }

    public function deductions()
    {
        return $this->hasMany('App\Deduction');
    }
}
