<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

use App\Http\Requests\AddOtherRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Addother;
use App\Addotheritem;
use Laracasts\Flash\Flash;
use App\Payslip;

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
    public function store(AddOtherRequest $request)
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

        $this->syncAddotherTotal($request->payslip_id);

        if($addother){

            Flash::success('Successfully Created');

        }else{

            Flash::error('Please Try Again');

        }         

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

        $this->syncAddotherTotal($addother->payslip_id);        

        if($addother){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }          

        return $addother->name . 'has been successfully deleted';
    }

    private function syncAddotherTotal($payslip_id)
    {
        $addother = Addother::wherePayslipId($payslip_id)->get();

        $payslip = Payslip::findOrFail($payslip_id);

        $other_total = $addother->sum('deduct_amount');

        $payslip->other_total = $other_total;

        $payslip->net_pay = $payslip->basic + $payslip->add_total
                            - $payslip->deduct_total + $payslip->ot_total + $other_total;

        $payslip->save();        
    }       
}
