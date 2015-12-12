<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CampaignRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Campaign;
use Carbon\Carbon;
use Laracasts\Flash\Flash;

class CampaignController extends Controller
{

    /**Auth for all
     *
     */
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
        $campaigns =  Campaign::all();

        return $campaigns;
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('campaign.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignRequest $request)
    {

        if($request->input('end_date') and $request->input('return')){

            $request->merge(array('status' => 'Complete'));

        }else{

            $request->merge(array('status' => 'Proceeding'));

        }

        $input = $request->all();

        $campaign = Campaign::create($input);

        if($campaign){

            Flash::success('Successfully Created');

        }else{

            Flash::error('Please Try Again');

        }         

        return redirect('campaign');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = Campaign::findOrFail($id);

        return view('campaign.view', compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);

        return view('campaign.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignRequest $request, $id)
    {

        if($request->input('end_date') and $request->input('return')){

            $request->merge(array('status' => 'Complete'));

        }else{

            $request->merge(array('status' => 'Proceeding'));

        }

        $input = $request->all();

        $campaign = Campaign::findOrFail($id);

        $campaign->update($input);

        if($campaign){

            Flash::success('Successfully Updated');

        }else{

            Flash::error('Please Try Again');

        }         

        return redirect('campaign');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);

        $campaign->delete();

        if($campaign){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return redirect('campaign');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return json
     */
    public function destroyAjax($id)
    {
        $campaign = Campaign::findOrFail($id);

        $campaign->delete();

        if($campaign){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return $campaign->name . 'has been successfully deleted';
    }    
}
