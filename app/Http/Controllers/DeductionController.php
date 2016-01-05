<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\DeductionRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Deduction;
use App\DeductItem;
use Laracasts\Flash\Flash;
use App\Payslip;

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
    public function store(DeductionRequest $request)
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
    
        $this->syncDeductTotal($request->payslip_id);      

        if($deduction){

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
        $deduction = Deduction::findOrFail($id);

        $deduction->delete();

        $this->syncDeductTotal($deduction->payslip_id);

        if($deduction){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }          

        return $deduction->name . 'has been successfully deleted';
    } 

    private function syncDeductTotal($payslip_id)
    {
        $deduction = Deduction::wherePayslipId($payslip_id)->get();

        $payslip = Payslip::findOrFail($payslip_id);

        $deduct_total = $deduction->sum('deduct_amount');

        $payslip->deduct_total = $deduct_total;

        $payslip->net_pay = $payslip->basic + $payslip->add_total
                            - $deduct_total + $payslip->ot_total + $payslip->other_total;

        $payslip->save();        
    }        
}
