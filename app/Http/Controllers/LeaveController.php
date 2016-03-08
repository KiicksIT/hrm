<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Requests\LeaveRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Leave;
use App\LeaveAttach;
use Carbon\Carbon;
use App\Person;

class LeaveController extends Controller
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
        $leaves =  Leave::with(['person', 'person.department', 'person.position'])->get();

        return $leaves;
    }

    /**
     * Return viewing page.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('leave.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leave.create');
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
                'person_id',
            ]);

        $leave = Leave::create($request->all());

        if($leave){

            Flash::success('Successfully Created');

        }else{

            Flash::error('Please Try Again');

        }

        return redirect('leave');
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
        $leave = Leave::findOrFail($id);

        $leaveattaches = LeaveAttach::wherePersonId($leave->person_id)->latest()->paginate(10);

        return view('leave.edit', compact('leave', 'leaveattaches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LeaveRequest $request, $id)
    {

        $leave = Leave::findOrFail($id);

        $input = $request->all();

        $leave->update($input);

        if($leave){

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
        $leave = Leave::findOrFail($id);

        $leave->delete();

        if($leave){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }

        return redirect('leave');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return json
     */
    public function destroyAjax($id)
    {
        $leave = Leave::findOrFail($id);

        $leave->delete();

        if($leave){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }

        return $leave->id . 'has been successfully deleted';
    }

    public function addLeaveAttach(Request $request, $id)
    {
        // dd($request->all());
        $leave = Leave::findOrFail($id);
        // $person = Person::findOrFail($id);


        if($request->file('leave_attach')){

            $file = $request->file('leave_attach');

            $name = (Carbon::now()->format('dmYHi')).$file->getClientOriginalName();

            $file->move('person_asset/'.$leave->person->name.'/', $name);

            $leave->person->leaveattaches()->create(['path' => "/person_asset/".$leave->person->name."/{$name}", 'remark' => $request->remark]);

            Flash::success('Files Added');

        }else{

            if($request->remark){

                $leave->person->leaveattaches()->create(['remark' => $request->remark]);

                Flash::success('Files Added');

            }else{

                Flash::error('Please Attach File or Fill in the Remark');
            }

        }

        return Redirect::action('LeaveController@edit', $leave->id);
    }

    public function removeLeaveAttach($id)
    {
        $file = LeaveAttach::findOrFail($id);

        $leave = Leave::wherePersonId($file->person_id)->first();

        $filename = $file->path;

        $path = public_path();

        if (!File::delete($path.$filename))
        {
            if($file->leavepath){

                Flash::error('Please Try Again');

                return Redirect::action('LeaveController@edit', $leave->id);

            }else{

                $file->delete();

                Flash::success('Files Deleted');

                return Redirect::action('LeaveController@edit', $leave->id);
            }


        }else{

            $file->delete();

            Flash::success('Files Deleted');

            return Redirect::action('LeaveController@edit', $leave->id);
        }
    }

    public function exportAttachExcel($person_id)
    {
        $person = Person::findOrFail($person_id)->first();

        $title = 'LeaveAttach ('.$person->name.')';

        $leave_attach = LeaveAttach::wherePersonId($person_id)->latest()->get();

        Excel::create($title.'_'.Carbon::now()->format('dmYHis'), function($excel) use ($person, $leave_attach) {

            $excel->sheet('sheet1', function($sheet) use ($person, $leave_attach) {

                $sheet->setAutoSize(true);

                $sheet->setColumnFormat(array(
                    'A:T' => '@'
                ));

                $sheet->loadView('leave.exportExcel', compact('person', 'leave_attach'));

            });

        })->download('xls');
    }
}
