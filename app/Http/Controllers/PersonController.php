<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Person;
use Carbon\Carbon;
use App\StoreFile;
use App\Price;
use App\Transaction;
use Laracasts\Flash\Flash;
use App\Leave;
use App\Profile;
use PDF;
use App\User;

class PersonController extends Controller
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

    public function getData()
    {
        $person =  Person::with(['position', 'department'])->get();

        return $person;
    }  

    /**
     * Return viewing page.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('person.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('person.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonRequest $request)
    {
        if($request->prob_length and $request->prob_start){
            
            $request->merge(array('prob_end' => $this->calProbLength($request->prob_start, $request->prob_length)));

        }

        $resident = $request->has('resident')? 1 : 0;

        $medic_exam = $request->has('medic_exam')? 1 : 0; 

        $request->merge(['resident'=>$resident]);

        $request->merge(['medic_exam'=>$medic_exam]);

        if($request->file('avatar')){

            $file = $request->file('avatar');
            
            $name = (Carbon::now()->format('dmYHi')).$file->getClientOriginalName();

            $file->move('person_asset/avatar/', $name);

            $request->merge(array('avatar_path' => '/person_asset/avatar/'.$name));             
        }                

        $input = $request->all();

        $person = Person::create($input);

        // check whether leaves field filled or not
        if($request->paid_leave or $request->mc or $request->hospital_leave){

            // initiate leave records for this person
            $this->initLeave($request, $person);

        }

        if($person){

            Flash::success('Successfully Created');

        }else{

            Flash::error('Please Try Again');

        }        

        return redirect('person');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $person = Person::findOrFail($id);

        $files = StoreFile::wherePersonId($id)->oldest()->paginate(5);

        return view('person.edit', compact('person', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = Person::findOrFail($id);

        $files = StoreFile::wherePersonId($id)->oldest()->paginate(5);

        return view('person.edit', compact('person', 'files'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, $id)
    {

        $person = Person::findOrFail($id);

        $request->merge(array('contract_end' => $this->calContractLength($request->contract_start, $request->contract_length)));

        $request->merge(array('prob_end' => $this->calProbLength($request->prob_start, $request->prob_length)));

        $resident = $request->has('resident')? 1 : 0;

        $medic_exam = $request->has('medic_exam')? 1 : 0; 

        $request->merge(['resident'=>$resident]);

        $request->merge(['medic_exam'=>$medic_exam]); 

        if($request->file('avatar')){

            $file = $request->file('avatar');
            
            $name = (Carbon::now()->format('dmYHi')).$file->getClientOriginalName();            

            if($person->avatar_path){

                $path = public_path();

                File::delete($path.$person->avatar_path);
            
            }

            $file->move('person_asset/avatar/', $name);
            
            $request->merge(array('avatar_path' => '/person_asset/avatar/'.$name));
        }     

        $input = $request->all();

        $person->update($input);

        if($person){

            Flash::success('Successfully Updated');

        }else{

            Flash::error('Please Try Again');

        }        

        return Redirect::action('PersonController@edit', $person->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = Person::findOrFail($id);

        $person->delete();

        if($person){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return redirect('person');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return json
     */
    public function destroyAjax($id)
    {
        $person = Person::findOrFail($id);

        $person->delete();

        if($person){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return $person->name . 'has been successfully deleted';
    }

    public function addFile(Request $request, $id)
    {
        $person = Person::findOrFail($id);

        $file = $request->file('file');

        $name = (Carbon::now()->format('dmYHi')).$file->getClientOriginalName();

        $file->move('person_asset/file', $name);

        $person->files()->create(['path' => "/person_asset/file/{$name}"]);

        if($file){

            Flash::success('Files Added');

        }else{

            Flash::error('Please Try Again');

        }         

    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function removeFile($id)
    {
        $file = StoreFile::findOrFail($id);

        $filename = $file->path;

        $path = public_path();

        if (!File::delete($path.$filename))
        {

            Flash::error('Please Try Again');

            return Redirect::action('PersonController@edit', $file->person_id);
        }
        else
        {
            $file->delete();

            Flash::success('Files Deleted');

            return Redirect::action('PersonController@edit', $file->person_id);
        }
    }

    public function showTransac($person_id)
    {
        return Transaction::with('user')->wherePersonId($person_id)->get();
    }

    public function convertToUser($person_id)
    {
        $person = Person::findOrFail($person_id);

        if(! $person->user_id){

            $user = new User();

            $user->name = $person->name;

            $user->email = $person->email;

            $user->username = strtolower(preg_replace('/\s+/', '', $person->name));

            $user->password = 'abcde12345';

            $user->contact = $person->contact;

            $user->save();

            $person->user_id = $user->id;

            $person->save();

            if($person){

                Flash::success('User Added');

            }else{

                Flash::error('Please Try Again');

            }        

        }else{

            Flash::error('This Employee has already been added as user');
        }

        return Redirect::action('PersonController@edit', $person->id);        
    }

    // printing pdf version of payslip
    public function generateKET($id)    
    {
        $person = Person::findOrFail($id);

        $profile = Profile::firstOrFail();

        $data = [
            'person'   =>  $person,
            'profile'  =>  $profile,
        ];

        $name = 'KET_('.$person->name.')-'.Carbon::now()->format('dmYHis').'.pdf';

        $pdf = PDF::loadView('person.printket_ch', $data);

        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download($name);

    }      

    // create leave records for the person
    private function initLeave($request, $person)
    {
        $leave = new Leave();

        $leave->total_paidleave = $request->paid_leave;

        $leave->total_paidsickleave = $request->mc;

        $leave->total_paidhospleave = $request->hospital_leave;

        $leave->person_id = $person->id;

        $leave->save();        
    }

    // calculate probabtion length
    private function calProbLength($prob_start, $prob_length)
    {
        switch($prob_length){

            case 'None': 
                $prob_end = null;
                break;

            case '1 Month':
                $prob_end = Carbon::parse($prob_start)->addMonth();
                break;

            case '2 Months';
                $prob_end = Carbon::parse($prob_start)->addMonths(2);
                break;

            case '3 Months';
                $prob_end = Carbon::parse($prob_start)->addMonths(3);
                break;

            case '6 Months';
                $prob_end = Carbon::parse($prob_start)->addMonths(6);
                break;                                
        }

        if($prob_end != null){

            $prob_end = $prob_end->format('d-F-Y');

        }

        return $prob_end;
    }

    // calculate contract length
    private function calContractLength($contract_start, $contract_length)
    {
        switch($contract_length){

            case 'None': 
                $contract_end = null;
                break;

            case '1 Year':
                $contract_end = Carbon::parse($contract_start)->addYear();
                break;

            case '2 Years';
                $contract_end = Carbon::parse($contract_start)->addYears(2);
                break;

            case '3 Years';
                $contract_end = Carbon::parse($contract_start)->addYears(3);
                break;

            case '4 Years';
                $contract_end = Carbon::parse($contract_start)->addYears(4);
                break;                                
        }

        if($contract_end != null){

            $contract_end = $contract_end->format('d-F-Y');

        }

        return $contract_end;
    }                  
  
}
