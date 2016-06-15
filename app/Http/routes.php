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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/article/{id}', function($id) {
    echo $id;
})->where('id','[0-9]+');

Route::get('/specail/show', [
    'as'    => 'show',
    function() {
        echo "show";
    }
]);

Route::controller('test', 'TestController');
Route::controller('student', 'StudentController');
//Route::get('/test/index', 'TestController@index');
//Route::get('/test/get/{id}', 'TestController@get');
//Route::get('/test/show', 'TestController@show');
//Route::post('/test/what', 'TestController@what');

//Route::post('/post/table', function (\App\Http\Requests\Request $request) {
//    $params = $request->all();
//    var_dump($params);
//});
