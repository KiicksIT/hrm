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
        $payslip =  Payslip::with(['person.department', 'person.position', 'person'])->latest()->get();

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
    public function create(Request $request)
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

        $request->merge(array('status' => 'Pending'));
        // set default dates

        $input = $request->all();

        $payslip = Payslip::create($input);

        $person = Person::findOrFail($request->person_id);

        if($person->resident == 1){

            $this->createCPFDeduction($payslip);

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

        $payslip = Payslip::with('person')->findOrFail($id);

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
        if($request->input('confirm')){

            $request->merge(array('status' => 'Confirmed'));

        }elseif($request->input('print')){

            $this->generatePayslip($id);
        }

        // update the respective payslip
        $payslip = Payslip::findOrFail($id);

        $payslip->update($request->all());

        //update epf when submit
        $this->calculateTotal($request, $payslip);

        if($payslip){

            Flash::success('Successfully Updated');

        }else{

            Flash::error('Please Try Again');

        }

        return Redirect::action('PayslipController@edit', $payslip->id);

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
    }

    // get person data based on person id
    public function getPersonData($person_id)
    {
        $person = Person::findOrFail($person_id)->first();

        return $person;
    }

    // add item section (B) angular
    public function getAddition($payslip_id)
    {
        $additions = Addition::wherePayslipId($payslip_id)->with('additem')->get();

        return $additions;
    }

    // deduct item section (C) angular
    public function getDeduction($payslip_id)
    {
        $deductions = Deduction::wherePayslipId($payslip_id)->with('deductitem')->get();

        return $deductions;
    }

    // addother section (E) angular
    public function getAddOther($payslip_id)
    {
        $addothers = Addother::wherePayslipId($payslip_id)->with('addotheritem')->get();

        return $addothers;
    }

    // printing pdf version of payslip
    public function generatePayslip($id)
    {
        $payslip = Payslip::findOrFail($id);

        $person = Person::findOrFail($payslip->person_id);

        $additions = Addition::with('additem')->wherePayslipId($payslip->id)->get();

        $deductions = Deduction::with('deductitem')->wherePayslipId($payslip->id)->get();

        if($person->resident){

            $employeecpf = Deduction::wherePayslipId($payslip->id)->whereDeductitemId(1)->first()->deduct_amount;
        }else{

            $employeecpf = '';
        }


        $addothers = AddOther::wherePayslipId($payslip->id)->get();

        $profile = Profile::firstOrFail();

        $data = [
            'payslip'  =>  $payslip,
            'person'   =>  $person,
            'additions' =>  $additions,
            'deductions'=>  $deductions,
            'addothers' =>  $addothers,
            'profile'  =>  $profile,
            'employeecpf'  =>  $employeecpf,
        ];

        $name = 'Payslip_('.$person->name.')-'.Carbon::now()->format('dmYHis').'.pdf';

        $pdf = PDF::loadView('payslip.printpdf_ch', $data);

        $pdf->setPaper('a4');

        return $pdf->download($name);

    }

    // create cpf item as first item for Singaporean/ PR
    private function createCPFDeduction($payslip)
    {
        $deductitem = DeductItem::firstOrFail();

        $deduction = new Deduction;

        $deduction->deduct_amount = NULL;

        $deduction->deductitem_id = $deductitem->id;

        $deduction->payslip_id = $payslip->id;

        $deduction->save();

        return $deduction;
    }



    // update cpf when submit button
    private function calculateTotal($request, $payslip)
    {
        $person = Person::findOrFail($payslip->person_id);

        if($person->resident == 1){

            $age = Carbon::createFromFormat('d-F-Y', $person->dob)->age;

            $totalPositive = $this->calCPFFormula($request, $payslip->id);

            if($age <=  55){

                $employerCpf = $totalPositive * 17/100;

                $employeeCpf = $totalPositive * 20/100;

            }else if($age > 55 && $age <= 60){

                $employerCpf = $totalPositive * 13/100;

                $employeeCpf = $totalPositive * 13/100;

            }else if($age > 60 && $age <= 65){

                $employerCpf = $totalPositive * 9/100;

                $employeeCpf = $totalPositive * 7.5/100;

            }else{

                $employerCpf = $totalPositive * 7.5/100;

                $employeeCpf = $totalPositive * 5/100;

            }

            $payslip->employee_epf = $employeeCpf;

            $payslip->employercont_epf = $employerCpf;

            $payslip->save();

            // dd($payslip->employee_epf);

            $deduction = Deduction::wherePayslipId($payslip->id)->whereDeductitemId(1)->first();

            if(! $deduction){

                $deduction = $this->createCPFDeduction($payslip);
            }

            $deduction->deduct_amount = $payslip->employee_epf;

            $deduction->save();

        }
            // cal net pay (A+B-C+D+E)
            $payslip->net_pay = $this->getBasic($request) + $this->getAdditionSum($payslip->id)
                                - $this->getDeductionSum($payslip->id) + $this->getOtSum($request) + $this->getAddotherSum($payslip->id);

            $payslip->save();

    }

    // Get A given the request
    private function getBasic($request)
    {
        $basic = $request->basic;

        return $basic;
    }


    // Get B given the payslip id
    private function getAdditionSum($payslip_id)
    {
        $addition = Addition::wherePayslipId($payslip_id)->get();

        $add_total = $addition->sum('add_amount');

        $payslip = Payslip::findOrFail($payslip_id);

        $payslip->add_total = $add_total;

        $payslip->save();

        return $add_total;
    }

    // Get C given the payslip id
    private function getDeductionSum($payslip_id)
    {
        $deduction = Deduction::wherePayslipId($payslip_id)->get();

        $deduct_total = $deduction->sum('deduct_amount');

        $payslip = Payslip::findOrFail($payslip_id);

        $payslip->deduct_total = $deduct_total;

        $payslip->save();

        return $deduct_total;
    }

    // Get D given the request
    private function getOtSum($request)
    {
        $ot_total = $request->ot_total;

        return $ot_total;
    }

    // Get E given the payslip id
    private function getAddotherSum($payslip_id)
    {
        $addother = Addother::wherePayslipId($payslip_id)->get();

        $addother_total = $addother->sum('addother_amount');

        $payslip = Payslip::findOrFail($payslip_id);

        $payslip->other_total = $addother_total;

        $payslip->save();

        return $addother_total;
    }

    // Suppose get the % after all the addition and deduction (A+B-C+D+E)
    private function calCPFFormula($request, $payslip_id)
    {
        // $totalPositive = $this->getBasic($request) + $this->getOtSum($request);
        $totalPositive = $this->getBasic($request) + $this->getOtSum($request) + $this->getAdditionSum($payslip_id) + $this->getAddotherSum($payslip_id);

        return $totalPositive;
    }




}
