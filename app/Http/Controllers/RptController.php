<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Person;
use App\Market;
use App\Transaction;
use App\Item;
use App\Campaign;


class RptController extends Controller
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
        return view('report.index');
    }    

    public function generatePerson(Request $request)
    {
        $title = 'Customer';

        $option = $request->input('cust_choice');

        if($option){

            switch($option) {
                
                case 'current':

                    $people = Person::all();

                    break;

                case 'lead':

                    $people = Market::whereStatus('Lead')->get();

                    break;

                case 'prospect':

                    $people = Market::whereStatus('Prospect')->get();

                    break;

            }            

        }else{

            $people = '';
        }


        if($people){

            Excel::create($title.'_'.Carbon::now()->format('dmYHis'), function($excel) use ($people, $option) {

                $excel->sheet('sheet1', function($sheet) use ($people, $option) {

                    $sheet->setColumnFormat(array(
                        'A:P' => '@'
                    ));

                    $sheet->loadView('report.excel_person', compact('people', 'option'));

                });

            })->download('xls');

            Flash::success('Reports successfully generated');

        }else{

            if($option){

                Flash::error('There is no records for the selection report');

            }else{

                Flash::error('Please Select an Option');
            }

        }

        return redirect('report');
    }

    public function generateItem(Request $request)
    {
        $title = 'Product';

        $choice = $request->input('item_choice');

        $datefrom = $request->input('item_datefrom');

        $dateto = $request->input('item_dateto');

        $records = [];

        $itemdata = Item::all();


            if($choice == '0') {

                if($datefrom && $dateto){

                    $items = Transaction::searchDateRange($datefrom, $dateto);

                    $items = $items->get();

                }else{

                    $items = Transaction::all();

                }

            }else{

                $items = Transaction::whereHas('items', function($q) use ($choice){

                   $q->where('id', $choice);

                });
                
                if($datefrom && $dateto){

                    $items = $items->searchDateRange($datefrom, $dateto);

                }

                $items = $items->get();
            }

            if(count($items)>0){

                Excel::create($title.'_'.Carbon::now()->format('dmYHis'), function($excel) use ($items, $itemdata, $records) {

                    $excel->sheet('sheet1', function($sheet) use ($items, $itemdata, $records) {

                        $sheet->setAutoSize(true);

                        $sheet->setColumnFormat(array(
                            'A:P' => '@'
                        ));

                        $sheet->loadView('report.excel_item', compact('items', 'itemdata', 'records'));

                    });

                })->download('xls');

                Flash::success('Reports successfully generated');


            }else{

                Flash::error('There is no records for the selection report');

            }

            return redirect('report');                    

    }

    public function generateTransaction(Request $request)
    {
        $title = 'Transaction';

        $radiobtn = $request->input('choice_transac');

        $datefrom = $request->input('transaction_datefrom');

        $dateto = $request->input('transaction_dateto');

        $year = $request->input('transac_year');

        $month = $request->input('transac_month');

        switch($radiobtn){

            case 'tran_specific':

                if($datefrom && $dateto){

                    $date1 = $datefrom;

                    $date2 = $dateto;

                    $transactions = Transaction::searchDateRange($datefrom, $dateto)->with('person');

                    $transactions = $transactions->get();

                }else{

                    $date1 = Transaction::oldest('created_at')->first()->created_at;

                    $date2 = Transaction::latest('created_at')->first()->created_at;

                    $transactions = Transaction::with('person')->get();

                }

            break;

            case 'tran_all':

                $date1 = Carbon::parse('first day of January '.$year)->format('d-F-Y');

                $date2 = Carbon::parse('last day of December '.$year)->format('d-F-Y');

                $transactions = Transaction::searchYearRange($year)->with('person');

                $transactions = $transactions->get();

            break;

            case 'tran_month':

                $date1 = Carbon::create(Carbon::now()->year, $month)->startOfMonth()->format('d-F-Y');

                $date2 = Carbon::create(Carbon::now()->year, $month)->endOfMonth()->format('d-F-Y');

                $transactions = Transaction::searchMonthRange($month)->with('person');

                $transactions = $transactions->get();

            break;

        }

        if(count($transactions)>0){

            Excel::create($title.'_'.Carbon::now()->format('dmYHis'), function($excel) use ($transactions, $date1, $date2) {

                $excel->sheet('sheet1', function($sheet) use ($transactions, $date1, $date2) {

                    $sheet->setColumnFormat(array(
                        'A:P' => '@'
                    ));

                    $sheet->loadView('report.excel_transaction', compact('transactions', 'date1', 'date2'));

                });

            })->download('xls');

            Flash::success('Reports successfully generated');

        }else{

            Flash::error('There is no records for the selection report');

        }

        return redirect('report');        
    }

    public function generateCampaign(Request $request)
    {
        $title = 'Event';

        $choice = $request->input('campaign_choice');

        $record = '';

        if($choice == 'inprogress'){

            $campaigns = Campaign::searchStatus('Proceeding');

            $campaigns = $campaigns->get();

        }else if($choice == 'done'){

            $campaigns = Campaign::searchStatus('Complete');

            $campaigns = $campaigns->get();


        }else{
            $campaigns = Campaign::all();

        }

        if(count($campaigns)>0){

            Excel::create($title.'_'.Carbon::now()->format('dmYHis'), function($excel) use ($campaigns, $record) {

                $excel->sheet('sheet1', function($sheet) use ($campaigns, $record) {

                    $sheet->setColumnFormat(array(
                        'A:P' => '@'
                    ));

                    $sheet->loadView('report.excel_campaign', compact('campaigns', 'record'));

                });

            })->download('xls');

            Flash::success('Reports successfully generated');

        }else{

            Flash::error('There is no records for the selection report');

        }

        return redirect('report');        
    }

}
