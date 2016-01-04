<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\MainIndexRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MainIndex;
use Laracasts\Flash\Flash;

class MainIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainindexes = MainIndex::latest()->paginate(5);

        return view('mainindex.index', compact('mainindexes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainIndexRequest $request)
    {
        $input = $request->all();

        $mainindex = MainIndex::create($input);

        if($mainindex){

            Flash::success('Successfully Created');

        }else{

            Flash::error('Please Try Again');

        }         

        return redirect('mainindex');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mainindex = MainIndex::findOrFail($id);

        $mainindex->delete();

        if($mainindex){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return redirect('mainindex');
    }
}
