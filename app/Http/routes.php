<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','PagesController@home');
Route::get('about/{page}','PagesController@about');
Route::get('contact','PagesController@contact');



// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// Login with GitHub
Route::get('auth/github','GithubLoginController@login');



// Registration routes...
Route::get('auth/register', 'RegistrationController@register');
Route::post('auth/register', 'RegistrationController@postRegister');
Route::get('register/confirm/{token}', 'ActivationsController@confirmEmail');



// Password routes...
Route::get('password/email','Auth\PasswordController@getEmail');
Route::post('password/email','Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


// Test routes...
Route::get('/test','TestController@index');
Route::get('/test/test','TestController@test');
Route::get('/test/index',function(){
    return view('test.index');
});


// Quests routes...
Route::resource('quests/done','ExecuteQuestsController@update');
Route::resource('quests/execute','ExecuteQuestsController');
Route::post('quests/upload','QuestsController@upload');
Route::get('quests/my','MyQuestsController@index');
Route::resource('quests','QuestsController');

// Docs
Route::post('docsearch','DocsController@search');
Route::resource('docs','DocsController');

//Manage
Route::put('check/publish/{id}','CheckQuestsController@publish');
Route::post('check/priority/open','CheckQuestsController@open');
Route::post('check/priority/move','CheckQuestsController@move');
Route::get('check/priority','CheckQuestsController@priority');
Route::get('check/all','CheckQuestsController@index');
Route::put('check/completion/{id}','CheckQuestsController@isCompleted');
Route::get('check/completion','CheckQuestsController@completion');


// Notifications
Route::resource('notifications','NotificationsController');


//
Route::get('roles/assign','RolesController@assign');
Route::get('roles/skills/{id}','SkillsController@subSkills');
Route::resource('roles/skills','SkillsController');
Route::get('roles','RolesController@index');


//User
Route::get('profiles/avatar/link','AvatarsController@getAvatarLink');
Route::get('profiles/avatar/crop','AvatarsController@edit');       //IE11以下的老版本
Route::post('profiles/avatar/upload','AvatarsController@upload');
Route::post('profiles/avatar/update','AvatarsController@update');  //����ͷ��
Route::get('profiles/avatar','AvatarsController@editAvatar');

Route::resource('profiles','ProfilesController');


//Team
Route::post('team/code','TeamsController@search');
Route::get('team/sponsor','TeamsController@sponsor');
Route::post('team/confirm','TeamsController@confirm');
Route::post('team/send','TeamsController@send');
Route::post('team/accept','TeamsController@accept');

Route::get('team','TeamsController@index');

//Privacy

Route::post('setting/switch','SettingsController@switchSetting');


//Status
Route::get('status/weekly','StatusController@weekly');
Route::get('status/done','StatusController@test');
Route::resource('status','StatusController');

//locale
Route::get('language/{locale}', 'LanguagesController@switchLang');

//Search
Route::get('search/quest', 'SearchController@quest');

//department
Route::resource('department','DepartmentsController');



Route::resource('manage','ManageController');

//decision

Route::post('decision/vote','DecisionsController@vote');
Route::resource('decision/participate','DecisionsController@participate');
Route::resource('decision','DecisionsController');


Route::put('finance/outcome/grant/{id}','OutcomesController@grant');
Route::put('finance/outcome/executed/{id}','OutcomesController@executed');
Route::resource('finance/outcome','OutcomesController');
Route::resource('finance/invest','InvestsController');
Route::get('finance/income','FinanceController@income');
Route::get('finance/trade/purchase','TradeController@purchase');
Route::resource('finance/trade','TradeController');
Route::resource('finance','FinanceController');

Route::get('settings','SettingsController@index');

Route::post('queue', function()
{
    return Queue::marshal();
});


