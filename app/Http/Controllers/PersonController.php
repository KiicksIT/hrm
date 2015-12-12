<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Person;
use Carbon\Carbon;
use App\StoreFile;
use App\Price;
use App\Transaction;
use Laracasts\Flash\Flash;

class PersonController extends Controller
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
        $person =  Person::all();

        return $person;
    }  

    /**
     * Return viewing page.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('person.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('person.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonRequest $request)
    {
        $input = $request->all();

        $person = Person::create($input);

        if($person){

            Flash::success('Successfully Created');

        }else{

            Flash::error('Please Try Again');

        }        

        return redirect('person');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $person = Person::findOrFail($id);

        $transactions = Transaction::where('person_id', $id)->latest()->simplePaginate(10);

        $files = StoreFile::wherePersonId($id)->latest()->paginate(5);

        $prices = Price::wherePersonId($id)->oldest()->paginate(10);

        return view('person.edit', compact('person', 'transactions', 'files', 'prices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = Person::findOrFail($id);

        $transactions = Transaction::where('person_id', $id)->latest()->simplePaginate(10);

        $files = StoreFile::wherePersonId($id)->oldest()->paginate(5);

        $prices = Price::wherePersonId($id)->oldest()->paginate(10);

        return view('person.edit', compact('person', 'transactions', 'files', 'prices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, $id)
    {
        
        $person = Person::findOrFail($id);

        $input = $request->all();

        $person->update($input);

        if($person){

            Flash::success('Successfully Updated');

        }else{

            Flash::error('Please Try Again');

        }        

        return Redirect::action('PersonController@edit', $person->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = Person::findOrFail($id);

        $person->delete();

        if($person){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return redirect('person');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return json
     */
    public function destroyAjax($id)
    {
        $person = Person::findOrFail($id);

        $person->delete();

        if($person){

            Flash::success('Successfully Deleted');

        }else{

            Flash::error('Please Try Again');

        }         

        return $person->name . 'has been successfully deleted';
    }

    public function addFile(Request $request, $id)
    {
        $person = Person::findOrFail($id);

        $file = $request->file('file');

        $name = (Carbon::now()->format('dmYHi')).$file->getClientOriginalName();

        $file->move('person_asset/file', $name);

        $person->files()->create(['path' => "/person_asset/file/{$name}"]);

        if($file){

            Flash::success('Files Added');

        }else{

            Flash::error('Please Try Again');

        }         

    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function removeFile($id)
    {
        $file = StoreFile::findOrFail($id);

        $filename = $file->path;

        $path = public_path();

        if (!File::delete($path.$filename))
        {

            Flash::error('Please Try Again');

            return Redirect::action('PersonController@edit', $file->person_id);
        }
        else
        {
            $file->delete();

            Flash::success('Files Deleted');

            return Redirect::action('PersonController@edit', $file->person_id);
        }
    }

    public function showTransac($person_id)
    {
        return Transaction::with('user')->wherePersonId($person_id)->get();
    }               
  
}
