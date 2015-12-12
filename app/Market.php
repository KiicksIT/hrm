<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Market extends Model
{
    protected $fillable = [
        'name', 'contact', 'appt_date',
        'subject', 'status', 'remark', 'email',
        'person_id', 'transaction_id',
        'company', 'office_no', 'roc_no',
        'address', 'amount', 'contract_start', 'contract_end', 'transremark', 'postcode'
    ];

    protected $dates = [
        'appt_date', 'contract_start', 'contract_end'
    ];

    public function setContractStartAttribute($date)
    {
        $this->attributes['contract_start'] = Carbon::parse($date);
    }

    public function setContractEndAttribute($date)
    {
        $this->attributes['contract_end'] = Carbon::parse($date);
    }

    public function setEmailAttribute($value) {
        $this->attributes['email'] = $value ?: null;
    }

    public function setRemarkAttribute($value) {
        $this->attributes['remark'] = $value ?: null;
    }

    public function setApptDateAttribute($date)
    {
        $this->attributes['appt_date'] = Carbon::createFromFormat('d-F-Y H:i A', $date);
    }

    public function getApptDateAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y h:iA');
    }    

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d-M-y');
    }     

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }    

    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
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

    /**
     * search and retrieve month data
     * @param $month in integer
     * @return mixed
     */
    public function scopeSearchDob($query, $month)
    {
        return $query->whereMonth('dob','=', $month);
    }
}
