<?php

//debug purpose
/*Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});*/

Route::get('/', function () {
    return view('welcome');
});

post('/person/download/{person_id}', 'PersonController@generateKET');
get('person/transac/{person_id}', 'PersonController@showTransac');
get('/person/data', 'PersonController@getData');
delete('/person/data/{id}', 'PersonController@destroyAjax');
resource('person', 'PersonController');
post('person/{id}/file', 'PersonController@addFile');
delete('person/{id}/file', 'PersonController@removeFile');

resource('profile', 'ProfileController');
// resource('sale', 'SaleController');

post('/payslip/download/{payslip_id}', 'PayslipController@generatePayslip');
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

resource('/massemail', 'MassEmailController');

get('/user/data', 'UserController@getData');
delete('/user/data/{id}', 'UserController@destroyAjax');
resource('user', 'UserController');

get('/role/data', 'RoleController@getData');
resource('role', 'RoleController');

get('/position/people/{position_id}', 'PositionController@getPositionPeople');
get('/position/data', 'PositionController@getData');
delete('/position/data/{id}', 'PositionController@destroyAjax');
resource('position', 'PositionController');

get('/department/people/{department_id}', 'DeptController@getDepartmentPeople');
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