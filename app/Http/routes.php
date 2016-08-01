<?php

//debug purpose
/*Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/personatts/{person_id}', 'PersonAttsController@getIndex');
Route::resource('personatts', 'PersonAttsController');

Route::get('/person/user/{person_id}', 'PersonController@convertToUser');
Route::post('/person/download/{person_id}', 'PersonController@generateKET');
Route::get('person/transac/{person_id}', 'PersonController@showTransac');
Route::get('/person/data', 'PersonController@getData');
Route::get('/person/createData/{month}', 'PersonController@getDataMonth');
Route::delete('/person/data/{id}', 'PersonController@destroyAjax');
Route::resource('person', 'PersonController');
Route::post('person/{id}/file', 'PersonController@addFile');
Route::delete('person/{id}/file', 'PersonController@removeFile');

Route::get('/profile/data', 'ProfileController@getData');
Route::get('/profile/{id}/edit/policy', 'ProfileController@editPolicy');
Route::resource('profile', 'ProfileController');

Route::post('/payslip/download/{payslip_id}', 'PayslipController@generatePayslip');
Route::get('/payslip/addother/{payslip_id}', 'PayslipController@getAddOther');
Route::get('/payslip/deduction/{payslip_id}', 'PayslipController@getDeduction');
Route::get('/payslip/addition/{payslip_id}', 'PayslipController@getAddition');
Route::get('/payslip/person/{person_id}', 'PayslipController@getPersonData');
Route::delete('/payslip/data/{id}', 'PayslipController@destroyAjax');
Route::get('/payslip/data', 'PayslipController@getData');
Route::resource('payslip', 'PayslipController');

Route::get('/addition/data/{id}', 'AdditionController@getData');
Route::delete('/addition/data/{id}', 'AdditionController@destroyAjax');
Route::resource('addition', 'AdditionController');

Route::get('/deduction/data/{id}', 'DeductionController@getData');
Route::delete('/deduction/data/{id}', 'DeductionController@destroyAjax');
Route::resource('deduction', 'DeductionController');

Route::get('/addother/data/{id}', 'AddOtherController@getData');
Route::delete('/addother/data/{id}', 'AddOtherController@destroyAjax');
Route::resource('addother', 'AddOtherController');

Route::get('/leave/leaveattach/excel/{person_id}', 'LeaveController@exportAttachExcel');
Route::post('/leave/leaveattach/{id}', 'LeaveController@addLeaveAttach');
Route::delete('/leave/leaveattach/{id}', 'LeaveController@removeLeaveAttach');
Route::get('/leave/data/', 'LeaveController@getData');
Route::delete('/leave/data/{id}', 'LeaveController@destroyAjax');
Route::resource('leave', 'LeaveController');

Route::get('/applyleaves/data/', 'ApplyLeaveController@getAllData');
Route::get('/applyleave/data/', 'ApplyLeaveController@getData');
Route::delete('/applyleave/data/{id}', 'ApplyLeaveController@destroyAjax');
Route::resource('applyleave', 'ApplyLeaveController');

Route::resource('/massemail', 'MassEmailController');

Route::get('/user/data', 'UserController@getData');
Route::delete('/user/data/{id}', 'UserController@destroyAjax');
Route::resource('user', 'UserController');

Route::get('/role/data', 'RoleController@getData');
Route::resource('role', 'RoleController');

Route::get('/position/people/{position_id}', 'PositionController@getPositionPeople');
Route::get('/position/data', 'PositionController@getData');
Route::delete('/position/data/{id}', 'PositionController@destroyAjax');
Route::resource('position', 'PositionController');

Route::get('/department/people/{department_id}', 'DeptController@getDepartmentPeople');
Route::get('/department/data/', 'DeptController@getData');
Route::delete('/department/data/{id}', 'DeptController@destroyAjax');
Route::resource('department', 'DeptController');

Route::resource('mainindex', 'MainIndexController');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');