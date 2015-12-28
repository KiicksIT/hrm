<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Deduction;
use App\DeductItem;

class DeductionController extends Controller
{
    public function getData($id)
    {
        $deductions =  Deduction::with('deductitem')->get();

        return $deductions;
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $deductitem_id = $request->deductitem_id;

        if (substr($deductitem_id, 0, 4) == 'new:')
        {
            $deductitem = DeductItem::create(['name'=>substr($deductitem_id, 4)]);

            $deductitem_id = $deductitem->id;

            $request->merge(array('deductitem_id' => $deductitem_id));

        }  

        $input = $request->all();  

        $deduction = Deduction::create($input);

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
        $deduction = Deduction::findOrFail($id);

        $deduction->delete();

        return $deduction->name . 'has been successfully deleted';
    }     
}
