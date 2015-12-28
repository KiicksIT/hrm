<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Addition;
use App\AddItem;

class AdditionController extends Controller
{
    public function getData($id)
    {
        $additions =  Addition::with('additem')->get();

        return $additions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $additem_id = $request->additem_id;

        if (substr($additem_id, 0, 4) == 'new:')
        {
            $additem = AddItem::create(['name'=>substr($additem_id, 4)]);

            $additem_id = $additem->id;

            $request->merge(array('additem_id' => $additem_id));

        }  

        $input = $request->all();  

        $addition = Addition::create($input);

        return Redirect::action('PayslipController@edit', $request->payslip_id);
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return json
     */
    public function destroyAjax($id)
    {
        $addition = Addition::findOrFail($id);

        $addition->delete();

        return $addition->name . 'has been successfully deleted';
    }             
}
