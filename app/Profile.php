<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';

    protected $fillable =[
        'name', 'address', 'email',
        'contact', 'alt_contact', 'roc_no',
        'header', 'logo', 'footer',
        'payslip_start', 'payslip_end', 'payslip_otstart',
        'payslip_otend', 'payday', 'ot_payday',
        'notice' 
    ];

    public function setPayslipStartAttribute($alphanum)
    {
        $this->attributes['payslip_start'] = $this->convertAlphanum($alphanum);
    }

    public function getPayslipStartAttribute($number) 
    {
        return $this->convertNum($number);
    } 

    public function setPayslipEndAttribute($alphanum)
    {
        $this->attributes['payslip_end'] = $this->convertAlphanum($alphanum);
    }

    public function getPayslipEndAttribute($number) 
    {
        return $this->convertNum($number);
    }

    public function setPayslipOttartAttribute($alphanum)
    {
        $this->attributes['payslip_otstart'] = $this->convertAlphanum($alphanum);
    }

    public function getPayslipOtstartAttribute($number) 
    {
        return $this->convertNum($number);
    } 

    public function setPayslipOtendAttribute($alphanum)
    {
        $this->attributes['payslip_otend'] = $this->convertAlphanum($alphanum);
    }

    public function getPayslipOtendAttribute($number) 
    {
        return $this->convertNum($number);
    }

    public function setPaydayAttribute($alphanum)
    {
        $this->attributes['payday'] = $this->convertAlphanum($alphanum);
    }

    public function getPaydayAttribute($number) 
    {
        return $this->convertNum($number);
    }

    public function setOtPaydayAttribute($alphanum)
    {
        $this->attributes['ot_payday'] = $this->convertAlphanum($alphanum);
    }

    public function getOtPaydayAttribute($number) 
    {
        return $this->convertNum($number);
    }    

    private function convertAlphanum($alphanum)
    {
        return preg_replace( '/[^0-9]/', '', $alphanum);
    }

    private function convertNum($number)
    {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');

        if ((($number % 100) >= 11) && (($number%100) <= 13))

            return $number. 'th';

        else

            return $number. $ends[$number % 10];        
    }   
}
