<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MainIndexRequest extends Request
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
        $mainindex = $this->route('mainindex');

        return [
            'title' => 'required|unique:mainindexes,title,'.$mainindex,
            'content' => 'required',
        ];
    }
}
