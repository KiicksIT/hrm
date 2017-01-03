<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Month;

class MonthController extends Controller
{
    // retrieve all months
    public function getAllMonthsApi()
    {
    	$months = Month::all();
    	return $months;
    }
}
