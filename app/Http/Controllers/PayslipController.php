<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\PayslipRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Payslip;
use App\Department;
use App\Person;
use App\Position;
use App\Addition;
use App\Deduction;
use App\Addother;
use App\DeductItem;
use App\Profile;
use Carbon\Carbon;
use PDF;
use Laracasts\Flash\Flash;

class PayslipController extends Controller
{

    //auth-only login can see
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getData()
    {
        $payslip =  Payslip::with(['person.department', 'person.position', 'person'])->get();

        return $payslip;
    }  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payslip.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payslip.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'person_id' => 'required',
        ]);

        $input = $request->all();

        $payslip = Payslip::create($input);

        $person = Person::findOrFail($request->person_id);

        if($person->resident == 'Yes'){

            $this->createEPFDeduction($payslip);            

        }

        if($payslip){

            Flash::success('Successfully Created');

        }else{

            Flash::error('Please Try Again');

        }        

        return Redirect::action('PayslipController@edit', $payslip->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payslip = Payslip::findOrFail($id);

        return $payslip;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payslip = Payslip::findOrFail($id);

        return view('payslip.edit', compact('payslip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PayslipRequest $request, $id)
    {
        // lookup which button click, save or confirm
        if($request->input('save')){

            $request->merge(array('status' => 'Pending'));

        }elseif($request->input('confirm')){

            $request->merge(array('status' => 'Confirmed'));

        }elseif($request->input('print')){

            $this->generatePayslip($id);

        }

        // update the respective payslip
        $payslip = Payslip::findOrFail($id);

        $payslip->update($request->all());

        //update epf when submit
        $this->epfUpdate($payslip);

        if($payslip){

            Flash::success('Successfully Updated');

        }else{

            Flash::error('Please Try Again');

        }        

        if($request->input('save')){

            return redirect('payslip');

        }else{

            return Redirect::action('PayslipController@edit', $payslip->id);

        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payslip = Payslip::findOrFail($id);

        $payslip->delete();

        if($payslip){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return redirect('payslip');
    }

    /**
     * Remove the specified resource from storage.
     *transaction
     * @param  int  $id
     * @return json
     */
    public function destroyAjax($id)
    {
        $payslip = Payslip::findOrFail($id);

        $payslip->delete();

        if($payslip){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return view('payslip.index');
    }

    // get person data based on person id
    public function getPersonData($person_id)
    {
        $person = Person::findOrFail($person_id)->first();

        return $person;
    } 

    // add item section (B)
    public function getAddition($payslip_id)
    {
        $additions = Addition::wherePayslipId($payslip_id)->with('additem')->get();

        return $additions;
    } 

    // deduct item section (C)
    public function getDeduction($payslip_id)
    {
        $deductions = Deduction::wherePayslipId($payslip_id)->with('deductitem')->get();

        return $deductions;
    }         

    // addother section (E)
    public function getAddOther($payslip_id)
    {
        $addothers = Addother::wherePayslipId($payslip_id)->with('addotheritem')->get();

        return $addothers;
    } 

    // return person based on payslip id
    public function getPayslipPerson($payslip_id)
    {
        $payslip = Payslip::findOrFail($payslip_id);

        $person = Person::findOrFail($payslip->person_id);

        return $person;
    }

    // printing pdf version of payslip
    public function generatePayslip($id)    
    {
        $payslip = Payslip::findOrFail($id);

        $person = Person::findOrFail($payslip->person_id);

        $additions = Addition::with('additem')->wherePayslipId($payslip->id)->get();

        $deductions = Deduction::with('deductitem')->wherePayslipId($payslip->id)->get();

        $addothers = AddOther::wherePayslipId($payslip->id)->get();

        $profile = Profile::firstOrFail();

        $data = [
            'payslip'  =>  $payslip,
            'person'   =>  $person,
            'additions' =>  $additions,
            'deductions'=>  $deductions,
            'addothers' =>  $addothers,
            'profile'  =>  $profile,
        ];

        $name = 'Payslip_'.$person->name.Carbon::now()->format('dmYHis').'.pdf';

        $pdf = PDF::loadView('payslip.printpdf', $data);

        $pdf->setPaper('a4');
        
        return $pdf->download($name);

    }            

    // create epf item as first item for Singaporean/ PR
    private function createEPFDeduction($payslip)
    {
        $deductitem = DeductItem::firstOrFail();

        $deduction = new Deduction;

        $deduction->amount = NULL;

        $deduction->deductitem_id = $deductitem->id;

        $deduction->payslip_id = $payslip->id;

        $deduction->save();
    }  

    // update epf when submit button
    private function epfUpdate($payslip)
    {
        $person = Person::findOrFail($payslip->person_id);

        if($person->resident == 'Yes'){

            $deduction = Deduction::wherePayslipId($payslip->id)->whereDeductitemId(1)->first();

            $deduction->amount = $payslip->employee_epf;

            $deduction->save();
        }        
    }                  


}
