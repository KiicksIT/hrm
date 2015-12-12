<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MarketRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Market;
use App\Person;
use App\Transaction;
use Laracasts\Flash\Flash;

class MarketController extends Controller
{

    /**Auth for all
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getData1()
    {
        $markets =  Market::whereStatus('Lead')->get();

        return $markets;
    } 

    public function getData2()
    {
        $markets =  Market::whereStatus('Prospect')->get();

        return $markets;
    }

    public function getData3()
    {
        $markets =  Market::whereStatus('Closed')->get();

        return $markets;
    }                
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('market.index');
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

    //direct to diff create page based on button
    public function createDirect($choice)
    {
        return view('market.create', compact('choice'));
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarketRequest $request)
    {
        if($request->input('Lead')){

            $request->merge(array('status' => 'Lead'));

        }elseif($request->input('Prospect')){

            $request->merge(array('status' => 'Prospect'));

        }elseif($request->input('Closed')){

            $request->merge(array('status' => 'Closed'));

            $person_id = $this->savePerson($request->all());

            $request->merge(array('person_id' => $person_id));

            $this->saveTransaction($request);
        }

        $market = Market::create($request->all());

        if($market){

            Flash::success('Successfully Created');

        }else{

            Flash::error('Please Try Again');

        }        

        return redirect('market');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $market = Market::findOrFail($id);

        $status = $market->status;

        if($status == 'Lead'){

            $market->status = 'Prospect';

            $market->save();

        }elseif($status == 'Prospect'){

            $market->status = 'Lead';

            $market->save();

        }elseif($status == 'Closed'){

            return view ('market.form_view', compact('market'));

        }        

        return redirect('market');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $market = Market::findOrFail($id);

        return view('market.edit', compact('market'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarketRequest $request, $id)
    {
        if($request->input('edit_lead')){

            $request->merge(array('status' => 'Prospect'));

        }elseif($request->input('edit_prospect')){

            $request->merge(array('status' => 'Closed'));

            $person_id = $this->savePerson($request->all());

            $request->merge(array('person_id' => $person_id));

            $transaction_id = $this->saveTransaction($request);

            $request->merge(array('transaction_id' => $transaction_id));            

        }

        $market = Market::findOrFail($id);

        $input = $request->all();

        $market->update($input);

        if($market){

            Flash::success('Successfully Updated');

        }else{

            Flash::error('Please Try Again');

        } 

        return redirect('market');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $market = Market::findOrFail($id);

        $market->delete();

        if($market){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');
            
        }     

        return redirect('market');
    }

    private function savePerson($input)
    {
        $person = Person::create($input);

        return $person->id;
    }

    private function saveTransaction($request)
    {
        $transaction = Transaction::create($request->all());

        $this->syncItems($transaction, $request);

        return $transaction->id;
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
}
