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

Route::get('/boot/view', function() {
    return view('test.view');
});

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


/** --- 连表查询联系 ----- **/
/**
 * 初始化所需数据
 */
Route::get('/try/init', function() {

    //init rooms
    for ($roomId = 1; $roomId <5; $roomId++) {
        $room = new \App\Models\Room;
        $room->save();
        unset($room);
    }

    //init subjects
    $list = ['C++','JAVA', 'Database', 'Data Struct', 'Math','English'];
    foreach ($list as $subtitle) {
        $sub = new \App\Models\Subject;
        $sub->title = $subtitle;
        $sub->save();
        unset($sub);
    }

    //init subject-chooses
    $studentId = 16;
    $subId = [1,2,3,4,5,6];
    foreach ($subId as $sub) {
        for ($id = 1; $id<=$studentId; $id++){
            $random = mt_rand(1, 3);
            if ($random != 3) {
                $bind = new \App\Models\SubjectChoose();
                $bind->student_id = $id;
                $bind->subject_id = $sub;
                $bind->save();
                unset($bind);
            }
        }

    }
    echo "end";
});



Route::get('/try/hasmany', function() {
    $room = \App\Models\Room::find(3);
    var_dump($room->students->toArray());
});

Route::get('/try/belongsto', function() {
    $data = \App\Models\Student::find(1);
    var_dump($data->room->toArray());
});

Route::get('/try/with', function() {
    $data = \App\Models\Student::with('room')->whereIn('id',[1,2,3])->get();
    foreach ($data as $v) {
        var_dump($v->toArray());
    }
});

Route::get('try/belongstomany', function() {
    $data = App\Models\Subject::find(1);
    foreach($data->students as $student){
        var_dump($student->toArray());
    }
});

