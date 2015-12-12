<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PersonRequest extends Request
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
        $person = $this->route('person');

        return [
            'name'=>'required|min:3',
            'company' => 'unique:people,company,'.$person,
            'roc_no' => 'unique:people,roc_no,'.$person,
            'email'=>'email|unique:people,email,'.$person,
            'contact'=>array('regex:/^([0-9\s\-\+\(\)]*)$/'),
            'office_no'=>array('regex:/^([0-9\s\-\+\(\)]*)$/'),
            'postcode'=>'numeric',
        ];
    }
}
