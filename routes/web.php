<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//	你来
Route::get('/', function () {
    return view('welcome');
});
Route::any('index','zmyController@index');

Route::any('student/save',['uses' => 'StudentController@save']);
Route::any('student/create',['uses' => 'StudentController@create']);
Route::get('student/index',['uses' => 'StudentController@index']);

Route::any('student/saveadd','StudentController@saveadd');
Route::any('student/saveshow','StudentController@saveshow');
Route::any('student/savedel','StudentController@savedel');
Route::any('student/saveupdate','StudentController@saveupdate');
Route::any('student/update','StudentController@update');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//  文件上传
Route::any('upload','StudentController@upload');

Route::any('cache1','StudentController@cache1');
Route::any('cache2','StudentController@cache2');

//  签到
//Route::prefix('demo')->group(function(){

    Route::any('sign/index','Sign\SignController@index');
    Route::any('sign/doSign','Sign\SignController@doSign');
    Route::any('sign/getList','Sign\SignController@getList');

//});


//  学习类的路由组
Route::prefix('study')->group(function (){

    //  红包首页路由
    Route::get('bonus/index', 'Study\BonusController@index');
    //  红包添加路由
    Route::post('bonus/add', 'Study\BonusController@addBonus');
    //  红包列表
    Route::get('bonus/list', 'Study\BonusController@getList');
    //  红包详情
    Route::get('bonus/record/list', 'Study\BonusController@getBonusRecord');
    //  获取红包的路由
    Route::any('get/bonus', 'Study\BonusController@getBonus');

    //  竞猜添加页面
    Route::get('guess/add', 'Study\GuessController@add');
    //  执行竞猜添加
    Route::post('guess/doAdd', 'Study\GuessController@doAdd');
    //  竞猜列表页面
    Route::get('guess/list', 'Study\GuessController@list');

    //  竞猜
    Route::get('guess/guess', 'Study\GuessController@guess');
    //  竞猜
    Route::get('guess/result', 'Study\GuessController@checkResult');
    //  竞猜
    Route::post('guess/doGuess', 'Study\GuessController@doGuess');

    //  抽奖页面
    Route::get('lottery/index', 'Study\LotteryController@lottery');
    //  执行抽奖页面
//    Route::post('lottery/do', 'Study\LotteryController@doLottery');
    Route::post("lottery/do","Study\LotteryController@doLottery");
});



//  周考
Route::any('demo', 'ZhoukController@demo');
Route::any('doSing', 'ZhoukController@doSing');
Route::any('getList', 'ZhoukController@getList');

















