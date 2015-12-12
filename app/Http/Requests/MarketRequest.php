<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MarketRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $market = $this->route('market');

        return [
            'name'=>'required|min:3',
            'company'=>'unique:markets,company,'.$market,
            'roc_no'=>'unique:markets,roc_no,'.$market,
            'contact'=>array('regex:/^([0-9\s\-\+\(\)]*)$/'),
            'office_no'=>array('regex:/^([0-9\s\-\+\(\)]*)$/'),
            'email'=>'email|unique:markets,email,'.$market,
            'postcode'=>'numeric',
        ];
    }
}
