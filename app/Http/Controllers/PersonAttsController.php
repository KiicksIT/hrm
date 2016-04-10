<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonAttsRequest;
use App\Http\Controllers\Controller;
use App\PersonAtts;
use App\Person;

class PersonAttsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex($person_id)
    {
        $personatts = PersonAtts::where('person_id', $person_id)->with('person')->first();

        return $personatts;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($person_id)
    {
        $personatts = PersonAtts::where('person_id', $person_id)->first();

        if(!$personatts){

            $personatts = new PersonAtts;

            $personatts->person_id = $person_id;

            $personatts->save();
        }

        $person = Person::findOrFail($person_id);

        return view('personatts.edit', compact('personatts', 'person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonAttsRequest $request, $id)
    {
        $input = $request->all();

        $personatts = PersonAtts::findOrFail($id);

        $personatts->update($input);

        return Redirect::action('PersonController@edit', $personatts->person_id);

    }

}
