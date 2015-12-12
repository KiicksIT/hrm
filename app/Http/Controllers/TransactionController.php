<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\Item;
use App\Person;
use Carbon\Carbon;
use Laracasts\Flash\Flash;

class TransactionController extends Controller
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
    public function index(Request $request)
    {
        if($request->get('sortBy')){

            $sortBy = $request->get('sortBy');


            $transactions = Transaction::orderBy($sortBy, 'asc')->latest()->paginate(15);

        }else{

            $transactions = Transaction::latest()->paginate(15);

        }

        return view('transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $person_id = '';

        return view('transaction.create', compact('person_id'));
    }

    public function createWPerson($id)
    {
        $person_id = $id;

        return view('transaction.create', compact('person_id'));
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       

        $choice = $request->input('choice');

        $person_id = $request->input('person_id');

        if($person_id == ''){

            if($choice == 1){
                
                $request->merge(array('person_id' => $request->input('person')));

            }elseif($choice == 2){

                $person = Person::create($request->all());

                $request->merge(array('person_id' => $person->id));

            }
        }

        $transaction = Transaction::create($request->all());

        $this->syncItems($transaction, $request);            

        $this->sendNotification($request);

        if($transaction){

            Flash::success('Successfully Created');

        }else{

            Flash::error('Please Try Again');

        }

        if($person_id == ''){

            return redirect('transaction');

        }else{

            return Redirect::action('PersonController@edit', $person_id);

        }
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
        $transaction = Transaction::findOrFail($id);

        return view('transaction.edit', compact('transaction'));
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
        $transaction = Transaction::findOrFail($id);

        $transaction->update($request->all());

        $this->syncItems($transaction, $request);

        if($transaction){

            Flash::success('Successfully Updated');

        }else{

            Flash::error('Please Try Again');
            
        }

        return Redirect::action('PersonController@edit', $transaction->person_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->delete();

        if($transaction){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');
            
        }     

        return redirect('transaction');
    }


    private function syncItems($transaction, $request)
    {
        if ( ! $request->has('item_list'))
        {
            $transaction->items()->detach();
            return;
        }

        $allItemsId = array();

        foreach ($request->item_list as $itemId)
        {
            if (substr($itemId, 0, 4) == 'new:')
            {
                $newItem = Item::create(['name'=>substr($itemId, 4)]);
                $allItemsId[] = $newItem->id;
                continue;
            }
            $allItemsId[] = $itemId;
        }

        $transaction->items()->sync($allItemsId);
    }  

    private function sendNotification($request)
    {

        if($request->input('reminder')){

            $expirySub = Carbon::createFromFormat('d-F-Y', $request->input('contract_end'))->subMonths(2);

            $start = Carbon::now()->tomorrow()->startOfDay();

            $time = $start->diffInSeconds($expirySub, true);

            $today = Carbon::now()->format('d-F-Y');

            $user = Auth::user()->email;

            foreach($request->input('item_list') as $id){

                $item_list[] = Item::findOrFail($id)->name;

            }

            $item_list = implode(",", $item_list);

            $person = Person::findOrFail($request->input('person_id'));

            $data = array(

                'name' => $person->name,

                'nric' => $person->nric,

                'contact' => $person->contact,

                'contract_start' => $request->input('contract_start'),

                'contract_end' => $request->input('contract_end'),

                'transremark' => $request->input('transremark'),

                'item_list' => $item_list,

                'today' => $today

            );            



            if($expirySub > $start){

                Mail::later($time, 'email.reminder', $data, function ($message) use ($user)
                {
                    $message->from($user);
                    $message->subject('Contract Expiry Reminder for ['.\Carbon\Carbon::now()->format('d-F-Y').']');
                    $message->setTo($user);
                }); 

                // testing
               /* Mail::send( 'email.reminder', $data, function ($message) use ($user)
                {
                    $message->from($user);

                    $message->subject('Contract Expiry Reminder for ['.\Carbon\Carbon::now()->format('d-F-Y').']');

                    $message->setTo($user);
                });*/                 

            }else{

                Flash::error('Contract End to be Notified Less Than 2 Months from Today\'s Date');

            }  
        }         

    }  
}
