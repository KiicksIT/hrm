<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests\SchedulerRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Scheduler;
use Carbon\Carbon;
use Auth;
use App\User;
use Laracasts\Flash\Flash;

class SchedulerController extends Controller
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

    public function getData1()
    {
        $schedulers =  Scheduler::whereStatus('Pending')->get();

        return $schedulers;
    }  

    public function getData2()
    {
        $schedulers =  Scheduler::whereStatus('Complete')->get();

        return $schedulers;
    }      

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('scheduler.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchedulerRequest $request)
    {
        $request->merge(array('status' => 'Pending'));        

        $input = $request->all();

        $scheduler = Scheduler::create($input);

        if($request->input('email_list') and $request->input('notify_date')){

            $scheduler->users()->sync($request->input('email_list'));

            $this->sendNotification($request);
        }

        if($scheduler){

            Flash::success('Successfully Created');

        }else{

            Flash::error('Please Try Again');

        }        

        return redirect('scheduler');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // using as status switch
        $scheduler = Scheduler::findOrFail($id);

        $scheduler->status = 'Complete';

        $scheduler->save();

        return redirect('scheduler');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scheduler = Scheduler::findOrFail($id);

        return view('scheduler.edit', compact('scheduler'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SchedulerRequest $request, $id)
    {
                
        $input = $request->all();

        $scheduler = Scheduler::findOrFail($id);

        $scheduler->update($input);

        if($scheduler){

            Flash::success('Successfully Updated');

        }else{

            Flash::error('Please Try Again');

        }         

        return redirect('scheduler');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scheduler = Scheduler::findOrFail($id);

        $scheduler->delete();

        if($scheduler){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return redirect('scheduler');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return json
     */
    public function destroyAjax($id)
    {
        $scheduler = Scheduler::findOrFail($id);

        $scheduler->delete();

        if($scheduler){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return $scheduler->name . 'has been successfully deleted';
    }    

    private function sendNotification($request)
    {

        $lists = $request->input('email_list');

        $notify = $request->input('notify_date');

        $time = Carbon::now()->diffInSeconds(Carbon::parse($notify), true);

        $today = Carbon::now()->format('d-F-Y');

        $sender = Auth::user()->email;

        $data = array(

            'name' => $request->input('name'),

            'remark' => $request->input('remark'),

            'appt_date' => $request->input('appt_date'),

            'today' => $today
        );

        foreach($lists as $list){

            $user = User::findOrFail($list);

            $email[] = $user->email;

        }        

        Mail::later($time, 'email.scheduler', $data, function ($message) use ($email, $sender)
        {
            $message->from($sender);
            $message->subject('To Do\'s Reminder for ['.\Carbon\Carbon::now()->format('d-F-Y').']');
            $message->setTo($email);
        }); 

        // testing
       /* Mail::send( 'email.scheduler', $data, function ($message) use ($email, $sender)
        {
            $message->from($sender);

            $message->subject('To Do \'s Reminder for ['.\Carbon\Carbon::now()->format('d-F-Y').']');

            $message->setTo($email);
        }); */              

    }




}
