<?php

//debug purpose
/*Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});*/

Route::get('/', function () {
    return view('welcome');
});

get('/position/data', 'PositionController@getData');
delete('/position/data/{id}', 'PositionController@destroyAjax');
resource('position', 'PositionController');

get('person/transac/{person_id}', 'PersonController@showTransac');
get('/person/data', 'PersonController@getData');
delete('/person/data/{id}', 'PersonController@destroyAjax');
resource('person', 'PersonController');
post('person/{id}/file', 'PersonController@addFile');
delete('person/{id}/file', 'PersonController@removeFile');

resource('profile', 'ProfileController');
// resource('sale', 'SaleController');

get('/item/data', 'ItemController@getData');
delete('/item/data/{id}', 'ItemController@destroyAjax');
resource('item', 'ItemController');

resource('price', 'PriceController');

get('/transaction/create/{id}', 'TransactionController@createWPerson');
post('/transaction/log/{trans_id}', 'TransactionController@generateLogs');
post('/transaction/download/{trans_id}', 'TransactionController@generateInvoice');
get('/transaction/data', 'TransactionController@getData');
delete('/transaction/data/{id}', 'TransactionController@destroyAjax');
post('/transaction/{trans_id}/editpersoncode', 'TransactionController@storeCustcode');
put('/transaction/{trans_id}/editperson', 'TransactionController@storeCust');
put('/transaction/{trans_id}/total', 'TransactionController@storeTotal');
get('/transaction/person/{person_id}', 'TransactionController@getCust');
get('/transaction/item/{person_id}', 'TransactionController@getItem');
get('/transaction/person/{person_id}/item/{item_id}', 'TransactionController@getPrice');
resource('transaction', 'TransactionController');

get('/deal/data/{transaction_id}', 'DealController@getData');
delete('/deal/data/{id}', 'DealController@destroyAjax');
resource('deal', 'DealController');

get('/campaign/data', 'CampaignController@getData');
delete('/campaign/data/{id}', 'CampaignController@destroyAjax');
resource('campaign', 'CampaignController');

get('/scheduler/data1', 'SchedulerController@getData1');
get('/scheduler/data2', 'SchedulerController@getData2');
delete('/scheduler/data/{id}', 'SchedulerController@destroyAjax');
resource('scheduler', 'SchedulerController');

get('/market/data1', 'MarketController@getData1');
get('/market/data2', 'MarketController@getData2');
get('/market/data3', 'MarketController@getData3');
get('/market/create/{choice}', 'MarketController@createDirect');
delete('/market/data/{id}', 'MarketController@destroyAjax');
resource('market', 'MarketController');

get('/report', 'RptController@index');
post('/report/person', 'RptController@generatePerson');
post('/report/item', 'RptController@generateItem');
post('/report/transaction', 'RptController@generateTransaction');
post('/report/campaign', 'RptController@generateCampaign');


get('/user/data', 'UserController@getData');
delete('/user/data/{id}', 'UserController@destroyAjax');
resource('user', 'UserController');

get('/role/data', 'RoleController@getData');
resource('role', 'RoleController');


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');