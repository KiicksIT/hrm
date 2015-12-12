<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SchedulerRequest extends Request
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
        $scheduler = $this->route('scheduler');

        return [
            'name' => 'required|unique:schedulers,name,'.$scheduler,
        ];
    }
}
