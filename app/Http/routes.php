<?php

//debug purpose
/*Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});*/

Route::get('/', function () {
    return view('welcome');
});

get('person/transac/{person_id}', 'PersonController@showTransac');
get('/person/data', 'PersonController@getData');
delete('/person/data/{id}', 'PersonController@destroyAjax');
resource('person', 'PersonController');
post('person/{id}/file', 'PersonController@addFile');
delete('person/{id}/file', 'PersonController@removeFile');

resource('profile', 'ProfileController');
// resource('sale', 'SaleController');

resource('price', 'PriceController');

get('/transaction/create/{id}', 'TransactionController@createWPerson');
post('/transaction/log/{trans_id}', 'TransactionController@generateLogs');
post('/transaction/download/{trans_id}', 'TransactionController@generateInvoice');
post('/transaction/{trans_id}/editpersoncode', 'TransactionController@storeCustcode');
put('/transaction/{trans_id}/editperson', 'TransactionController@storeCust');
put('/transaction/{trans_id}/total', 'TransactionController@storeTotal');
get('/transaction/person/{person_id}', 'TransactionController@getCust');
get('/transaction/item/{person_id}', 'TransactionController@getItem');
get('/transaction/person/{person_id}/item/{item_id}', 'TransactionController@getPrice');

post('/payslip/download/{payslip_id}', 'PayslipController@generatePayslip');
get('/payslip/{payslip_id}/person', 'PayslipController@getPayslipPerson');
get('/payslip/addother/{payslip_id}', 'PayslipController@getAddOther');
get('/payslip/deduction/{payslip_id}', 'PayslipController@getDeduction');
get('/payslip/addition/{payslip_id}', 'PayslipController@getAddition');
get('/payslip/person/{person_id}', 'PayslipController@getPersonData');
delete('/payslip/data/{id}', 'PayslipController@destroyAjax');
get('/payslip/data', 'PayslipController@getData');
resource('payslip', 'PayslipController');

get('/addition/data/{id}', 'AdditionController@getData');
delete('/addition/data/{id}', 'AdditionController@destroyAjax');
resource('addition', 'AdditionController');

get('/deduction/data/{id}', 'DeductionController@getData');
delete('/deduction/data/{id}', 'DeductionController@destroyAjax');
resource('deduction', 'DeductionController');

get('/addother/data/{id}', 'AddOtherController@getData');
delete('/addother/data/{id}', 'AddOtherController@destroyAjax');
resource('addother', 'AddOtherController');

get('/leave/data/', 'LeaveController@getData');
delete('/leave/data/{id}', 'LeaveController@destroyAjax');
resource('leave', 'LeaveController');

get('/scheduler/data1', 'SchedulerController@getData1');
get('/scheduler/data2', 'SchedulerController@getData2');
delete('/scheduler/data/{id}', 'SchedulerController@destroyAjax');
resource('scheduler', 'SchedulerController');

get('/report', 'RptController@index');
post('/report/person', 'RptController@generatePerson');
post('/report/item', 'RptController@generateItem');
post('/report/transaction', 'RptController@generateTransaction');
post('/report/campaign', 'RptController@generateCampaign');

resource('/massemail', 'MassEmailController');

get('/user/data', 'UserController@getData');
delete('/user/data/{id}', 'UserController@destroyAjax');
resource('user', 'UserController');

get('/role/data', 'RoleController@getData');
resource('role', 'RoleController');

get('/position/data', 'PositionController@getData');
delete('/position/data/{id}', 'PositionController@destroyAjax');
resource('position', 'PositionController');

get('/department/data/', 'DeptController@getData');
delete('/department/data/{id}', 'DeptController@destroyAjax');
resource('department', 'DeptController');

resource('mainindex', 'MainIndexController');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');