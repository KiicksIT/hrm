<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Position;
use Laracasts\Flash\Flash;

class PositionController extends Controller
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
        $position =  Position::all();

        return $position;
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('position.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('position.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $position = Position::create($input);

        if($position){

            Flash::success('Successfully Created');

        }else{

            Flash::error('Please Try Again');

        }        

        return redirect('position');
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
        $position = Position::findOrFail($id);

        return view('position.edit', compact('position'));
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
        $position = Position::findOrFail($id);

        $input = $request->all();

        $position->update($input);

        if($position){

            Flash::success('Successfully Updated');

        }else{

            Flash::error('Please Try Again');

        }        

        return redirect('position');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $position = Position::findOrFail($id);

        $position->delete();

        if($position){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return redirect('position');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return json
     */
    public function destroyAjax($id)
    {
        $position = Position::findOrFail($id);

        $position->delete();

        if($position){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return $position->name . 'has been successfully deleted';
    }    
}
