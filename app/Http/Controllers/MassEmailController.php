<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Person;
use App\Market;

class MassEmailController extends Controller
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
     * @return Response
     */
    public function index()
    {
        $customers = Person::whereNotNull('email')->paginate(10);

        $leads = Market::whereNotNull('email')->whereStatus('Lead')->paginate(10);

        $prospects = Market::whereNotNull('email')->whereStatus('Prospect')->paginate(10);

        $emails = [];

        $email_list = '';

        return view('massemail.index', compact('customers', 'emails', 'email_list', 'leads', 'prospects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $customers = Person::whereNotNull('email')->paginate(10);

        $leads = Market::whereNotNull('email')->whereStatus('Lead')->paginate(10);

        $prospects = Market::whereNotNull('email')->whereStatus('Prospect')->paginate(10);

        if(count($request->input('email')) > 0){
            $emails = $request->input('email');
        }else{
            $emails = [];
        }

        $checked = $request->input('selection');

        if(count($checked) > 0) {
            $checks = array_unique($checked);


            foreach ($checks as $check) {

                if (strrchr($check, 'a')) {
                    $cust_db = preg_replace('/[^0-9\-]/', '', $check);

                    $customer = Person::findOrFail($cust_db);

                    array_push($emails, $customer->email);

                } else {
                    $sale_db = preg_replace('/[^0-9\-]/', '', $check);

                    $customer = Market::findOrFail($sale_db);

                    array_push($emails, $customer->email);
                }
            }
        }

        $emails = array_unique($emails);

        $email_list = implode(',', $emails);

        return view('massemail.index', compact('customers', 'checks', 'emails', 'email_list', 'leads', 'prospects'));

    }
}
