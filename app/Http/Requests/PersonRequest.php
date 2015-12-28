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
            'nric_fin' => 'unique:people,nric_fin,'.$person,
            'email'=>'email|unique:people,email,'.$person,
            'contact'=>array('regex:/^([0-9\s\-\+\(\)]*)$/'),
            'basic'=>'numeric',
        ];
    }
}
