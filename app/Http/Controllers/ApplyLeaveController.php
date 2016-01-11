<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ApplyLeaveRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ApplyLeave;
use App\User;
use Auth;
use App\Person;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Leave;

class ApplyLeaveController extends Controller
{

    //auth-only login can see
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAllData()
    {
        $appyleaves =  ApplyLeave::with(['person', 'person.department', 'person.position'])->latest()->orderBy('status', 'desc')->get();

        return $appyleaves;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getData()
    {
        $person = Person::whereUserId(Auth::user()->id)->firstOrFail();

        $appyleaves =  ApplyLeave::wherePersonId($person->id)->get();

        return $appyleaves;
    }
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $person = Person::whereUserId(Auth::user()->id)->firstOrFail();

        return view('leave.apply.index', compact('person'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $person = Person::whereUserId(Auth::user()->id)->first();

        if($person == null){

            Flash::error('Logged user particulars didn\'t exist in Employee Database');

            return redirect('applyleave');
        }

        return view('leave.apply.create', compact('person'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplyLeaveRequest $request)
    {

        if(! $this->calDateLength($request->leave_from, $request->leave_to) == $request->day_num){

            Flash::success('Start/End date not tally with Total Day');

            return redirect('applyleave');
        }

        $person = Person::findOrFail($request->person_id)->first();

        if(! $this->validateLeaveCount($request->day_num, $request->leave_type, $person)){

            Flash::success('Claim day exceed available day');

            return redirect('applyleave');            
        }

        $input = $request->all();

        $applyleave = ApplyLeave::create($input);

        if($applyleave){

            Flash::success('Successfully Sent');

        }else{

            Flash::error('Please Try Again');

        } 

        return redirect('applyleave');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $applyleave = ApplyLeave::findOrFail($id);

        if($applyleave->person_id == null){

            $person = Person::whereUserId(Auth::user()->id)->first();    
        
        }else{

            $person = Person::findOrFail($applyleave->person_id);
        }

        

        return view('leave.apply.edit', compact('applyleave', 'person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $applyleave = ApplyLeave::findOrFail($id);

        if($request->input('btn_approve')){

            $this->deductLeaveCount($applyleave->leave_type, $applyleave->person_id, $applyleave->day_num);

            $request->merge(array('status' => 'Approve'));
        
        }elseif($request->input('btn_reject')){

            $request->merge(array('status' => 'Reject'));
        }        

        $input = $request->all();

        $applyleave->update($input);

        if($applyleave){

            Flash::success('Successfully Updated');

        }else{

            Flash::error('Please Try Again');

        } 

        return redirect('leave');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function calDateLength($leave_start, $leave_end)
    {
        $total_day = Carbon::parse($leave_start)->diffInDays(Carbon::parse($leave_end)) + 1; 

        return $total_day;
    }

    private function validateLeaveCount($day_num, $leave_type, $person)
    {
        switch($leave_type){
            case 1:
                if($person->leave->total_paidleave - $day_num < 0)
                    return false;
                else
                    return true;
                break;

            case 2:
                if($person->leave->total_paidsickleave - $day_num < 0)
                    return false;
                else
                    return true;
                break;

            case 3:
                if($person->leave->total_paidhospleave - $day_num < 0)
                    return false;
                else
                    return true;
                break;                               
        }

    }

    private function deductLeaveCount($leave_type, $person_id, $day_num)
    {
        if($leave_type != 'Unpaid Leave'){

            $leave = Leave::wherePersonId($person_id)->first();

            switch($leave_type){
                case 'Paid Leave':
                    $leave->total_paidleave = $leave->total_paidleave - $day_num;
                    break;

                case 'Paid Sick Leave':
                    $leave->total_paidsickleave = $leave->total_paidsickleave - $day_num;
                    break; 
                    
                case 'Paid Hospitalisation Leave':
                    $leave->total_paidhospleave = $leave->total_paidhospleave - $day_num;
                    break;                                                
            }

            $leave->save();
        }
    }
}
