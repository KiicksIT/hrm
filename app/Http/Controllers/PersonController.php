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

        $request->merge(array('prob_end' => $this->calProbLength($request->prob_start, $request->prob_length)));

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

        $request->merge(array('prob_end' => $this->calProbLength($request->prob_start, $request->prob_length)));

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

        $pdf = PDF::loadView('person.printket', $data);

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

    private function calProbLength($prob_start, $prob_length)
    {
        switch($prob_length){

            case 0: 
                $prob_end = null;
                break;

            case 1:
                $prob_end = Carbon::parse($prob_start)->addMonth();
                break;

            case 2;
                $prob_end = Carbon::parse($prob_start)->addMonths(2);
                break;

            case 3;
                $prob_end = Carbon::parse($prob_start)->addMonths(3);
                break;

            case 4;
                $prob_end = Carbon::parse($prob_start)->addMonths(6);
                break;                                
        }

        $prob_end = $prob_end->format('d-F-Y');

        return $prob_end;
    }              
  
}
