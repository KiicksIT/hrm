<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\DeptRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Department;
use Laracasts\Flash\Flash;
use App\Person;

class DeptController extends Controller
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
        $department =  Department::all();

        return $department;
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('department.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeptRequest $request)
    {
        $input = $request->all();

        $department = Department::create($input);

        if($department){

            Flash::success('Successfully Created');

        }else{

            Flash::error('Please Try Again');

        }        

        return redirect('department');        
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
        $department = Department::findOrFail($id);

        return view('department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeptRequest $request, $id)
    {
        $department = Department::findOrFail($id);

        $input = $request->all();

        $department->update($input);

        if($department){

            Flash::success('Successfully Updated');

        }else{

            Flash::error('Please Try Again');

        }        

        return redirect('department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);

        $department->delete();

        if($department){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return redirect('department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return json
     */
    public function destroyAjax($id)
    {
        $department = Department::findOrFail($id);

        $department->delete();

        if($department){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return $department->name . 'has been successfully deleted';
    }

    // get people based on dept
    public function getDepartmentPeople($id)
    {
        $people = Person::whereDepartmentId($id)->with('position')->get();

        return $people;
    }             
}
