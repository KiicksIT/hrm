<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\AdditionRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Addition;
use App\AddItem;
use Laracasts\Flash\Flash;
use App\Payslip;

class AdditionController extends Controller
{
    public function getData($id)
    {
        $additions =  Addition::with('additem')->get();

        return $additions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdditionRequest $request)
    {
        $additem_id = $request->additem_id;

        if (substr($additem_id, 0, 4) == 'new:')
        {
            $additem = AddItem::create(['name'=>substr($additem_id, 4)]);

            $additem_id = $additem->id;

            $request->merge(array('additem_id' => $additem_id));

        }  

        $input = $request->all();  

        $addition = Addition::create($input);

        $this->syncAddTotal($request->payslip_id);

        if($addition){


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
        $addition = Addition::findOrFail($id);

        $addition->delete();

        $this->syncAddTotal($addition->payslip_id);

        if($addition){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }          

        return $addition->name . 'has been successfully deleted';
    } 

    private function syncAddTotal($payslip_id)
    {
        $addition = Addition::wherePayslipId($payslip_id)->get();

        $payslip = Payslip::findOrFail($payslip_id);

        $add_total = $addition->sum('add_amount');

        $payslip->add_total = $add_total;

        $payslip->net_pay = $payslip->basic + $add_total 
                            - $payslip->deduct_total + $payslip->ot_total + $payslip->other_total;

        $payslip->save();        
    }            
}
