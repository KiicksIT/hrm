<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

        protected $fillable = [
        'name', 'nric', 'carplate',
        'email', 'contact', 'remark',
        'address'
        ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];    

    // set default nullable value upon detection
    public function setEmailAttribute($value) 
    {

        $this->attributes['email'] = $value ?: null;

    }       

    // set default nullable value upon detection
    public function setRemarkAttribute($value) 
    {

        $this->attributes['remark'] = $value ?: null;
        
    } 

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }    

    //select field populate selected
    public function getRoleListAttribute()
    {
        return $this->roles->lists('id')->all();
    } 

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d-F-Y');
    }    

    public function transaction()
    {
        return $this->hasMany('App\Transaction');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function market()
    {
        return $this->hasOne('App\Market');
    }

    public function files()
    {
        return $this->hasMany('App\StoreFile');
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
