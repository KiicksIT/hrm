<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

        protected $fillable = [
        'name', 'nric_fin', 'contract_type',
        'gender', 'dob','nationality', 'resident',
        'contact', 'address', 'email',
        'start_date', 'end_date', 'leave_reason',
        'education', 'person_remark', 'basic',
        'ot_rate', 'prob_start', 'prob_end', 'department_id',
        'hour_remark', 'day_remark', 'off_remark',
        'position_id', 'basic_rate', 'paid_leave',
        'mc', 'hospital_leave', 'medic_exam',
        'benefit_remark', 'prob_length', 'contract_start',
        'contract_end', 'contract_length', 'other_leave',
        'salary_component', 'user_id'
        ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'dob', 'start_date', 'end_date' ,'deleted_at', 'prob_start', 'prob_end',
        'contract_start', 'contract_end'
    ]; 

    public function setStartDateAttribute($date)
    {
        if($date){

            $this->attributes['start_date'] = Carbon::parse($date);

        }else{

            $this->attributes['start_date'] = null;

        }
    } 

    public function setEndDateAttribute($date)
    {
        if($date){

            $this->attributes['end_date'] = Carbon::parse($date);

        }else{

            $this->attributes['end_date'] = null;

        }
    } 

    public function setDobAttribute($date)
    {
        if($date){

            $this->attributes['dob'] = Carbon::parse($date);
            // $this->attributes['dob'] = Carbon::createFromFormat('d-F-Y', $date)->toDateTimeString();

        }else{

            $this->attributes['dob'] = null;

        }
    } 

    public function setProbStartAttribute($date)
    {
        if($date){

            $this->attributes['prob_start'] = Carbon::parse($date);
            // $this->attributes['dob'] = Carbon::createFromFormat('d-F-Y', $date)->toDateTimeString();

        }else{

            $this->attributes['prob_start'] = null;

        }
    } 

    public function setProbEndAttribute($date)
    {
        if($date){

            $this->attributes['prob_end'] = Carbon::parse($date);
            // $this->attributes['dob'] = Carbon::createFromFormat('d-F-Y', $date)->toDateTimeString();

        }else{

            $this->attributes['prob_end'] = null;

        }
    }

    public function setContractStartAttribute($date)
    {
        if($date){

            $this->attributes['contract_start'] = Carbon::parse($date);

        }else{

            $this->attributes['contract_start'] = null;

        }
    } 

    public function setContractEndAttribute($date)
    {
        if($date){

            $this->attributes['contract_end'] = Carbon::parse($date);

        }else{

            $this->attributes['contract_end'] = null;

        }
    }        

    public function getContractStartAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }

    public function getContractEndAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }                              

    // dates format
    public function getDobAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }  

    public function getStartDateAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }  

    public function getEndDateAttribute($date)
    {
        if($date){

            return Carbon::parse($date)->format('d-F-Y');

        }else{

            return '';
        }
        
    }          

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }

    public function getProbStartAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }

    public function getProbEndAttribute($date)
    {
        if($date){

            return Carbon::parse($date)->format('d-F-Y');
                
        }else{

            return null;
        }
        
    }                   

    public function transaction()
    {
        return $this->hasMany('App\Transaction');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function payslips()
    {
        return $this->hasMany('App\Payslip');
    }

    public function files()
    {
        return $this->hasMany('App\StoreFile');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    } 

    public function position()
    {
        return $this->belongsTo('App\Position');
    }  

    public function leave()
    {
        return $this->hasOne('App\Leave');
    }  

    public function applyleave()
    {
        return $this->hasOne('App\ApplyLeave');
    }                      
 

    /**
     * search like name
     * @param $name in string
     * @return mixed
     */
    public function scopeSearchName($query, $name)
    {
        return $query->where('name', 'like', "%$name%");
    }


    /**
     * search like contact
     * @param $contact in number
     * @return mixed
     */
    public function scopeSearchContact($query, $contact)
    {
        return $query->where('contact', 'like', "%$contact%");
    }

    /**
     * @param $query
     * @param $email
     * @return mixed
     */
    public function scopeSearchEmail($query, $email)
    {
        return $query->where('email', 'like', "%$email%");
    }       
   
}
