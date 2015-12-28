<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Addother;
use App\Addotheritem;

class AddOtherController extends Controller
{
    public function getData($id)
    {
        $addothers =  Addother::with('addotheritem')->get();

        return $addothers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addotheritem_id = $request->addotheritem_id;

        if (substr($addotheritem_id, 0, 4) == 'new:')
        {
            $addotheritem = Addotheritem::create(['name'=>substr($addotheritem_id, 4)]);

            $addotheritem_id = $addotheritem->id;

            $request->merge(array('addotheritem_id' => $addotheritem_id));

        }  

        $input = $request->all();  

        $addother = Addother::create($input);

        return Redirect::action('PayslipController@edit', $request->payslip_id);
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return json
     */
    public function destroyAjax($id)
    {
        $addother = Addother::findOrFail($id);

        $addother->delete();

        return $addother->name . 'has been successfully deleted';
    }  
}
