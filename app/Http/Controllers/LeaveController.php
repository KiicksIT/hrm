<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\LeaveRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Leave;

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

        return view('leave.edit', compact('leave'));
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
}
