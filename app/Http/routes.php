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

//Route::controller('test', 'TestController');
//Route::controller('student', 'StudentController');
Route::controllers(
    [
        'auth'      => 'Auth\AuthController',
        'password'  => 'Auth\PasswordController',
        'test'      => 'TestController',
        'student'   => 'StudentController',
        'login'     => 'LoginController'
    ]
);
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
//    //init rooms
//    for ($roomId = 1; $roomId <5; $roomId++) {
//        $room = new \App\Models\Room;
//        $room->save();
//        unset($room);
//    }
//    //init students room
//    \App\Models\Student::where('id','<',4)->update(['room_id',1]);
//    \App\Models\Student::where('id','>',3)->where('id','<',7)->update(['room_id',2]);
//    \App\Models\Student::where('id','>',6)->where('id','<',10)->update(['room_id',3]);
//    \App\Models\Student::where('id','>',9)->update(['room_id',4]);
//
//    //init subjects
//    $list = ['C++','JAVA', 'Database', 'Data Struct', 'Math','English'];
//    foreach ($list as $subtitle) {
//        $sub = new \App\Models\Subject;
//        $sub->title = $subtitle;
//        $sub->save();
//        unset($sub);
//    }
//
//    //init subject-chooses
//    $studentId = 16;
//    $subId = [1,2,3,4,5,6];
//    foreach ($subId as $sub) {
//        for ($id = 1; $id<=$studentId; $id++){
//            $random = mt_rand(1, 3);
//            if ($random != 3) {
//                $bind = new \App\Models\SubjectChoose();
//                $bind->student_id = $id;
//                $bind->subject_id = $sub;
//                $bind->save();
//                unset($bind);
//            }
//        }
//
//    }
    //init images
    $imgList = [
        'http://static.silov.me/art/images/pic01.png',
        'http://static.silov.me/art/images/pic02.png',
        'http://static.silov.me/art/images/pic03.png',
        'http://static.silov.me/upload/img/2016-06-12/575d170fa7a9f.jpg',
        'http://static.silov.me/upload/img/2016-05-18/573c048c65e14.jpg',
        'http://static.silov.me/upload/img/2016-05-18/573b47634c6d8.jpg'
    ];
    foreach ($imgList as $url) {
        $type = mt_rand(1,2);
        if ($type == 1) {
            $bindType = 'App\Models\Student';
            $bindId = mt_rand(1, 16);
        } else {
            $bindType = 'App\Models\Subject';
            $bindId = mt_rand(1, 6);
        }

        $img = new \App\Models\Image;
        $img->path = $url;
        $img->bind_type = $bindType;
        $img->bind_id = $bindId;
        $img->save();
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

/** ---- 多态关联模型 ---- **/
Route::get('try/morphto', function() {
    $student = \App\Models\Student::find(13);
    foreach($student->images as $image) {
        var_dump($image->toArray());
    }
});

Route::get('try/bind', function() {
    $image = \App\Models\Image::find(1);
    var_dump($image->bind->toArray());
});

/** ---- 获取关联 ---- **/
Route::get('try/has', function() {
//    $data = \App\Models\Room::has('students', '>', 4)->get();
    $data = \App\Models\Room::whereHas('students', function($query){
        $query->where('name','野原新之助');
    })->first();
    var_dump($data->toArray());
});

/** ----- 预加载 ----- **/
# 预加载模式
Route::get('/try/preload', function() {
    $data = \App\Models\Student::with('room')->whereIn('id', [1,5,10,16])->get();
    var_dump($data->toArray());
    foreach ($data as $v) {
        var_dump($v->room->toArray());
    }
});

# 非预加载模式
Route::get('/try/unpreload', function() {
    $data = \App\Models\Student::whereIn('id', [1,5,10,16])->get();
    var_dump($data->toArray());
    foreach ($data as $v) {
        var_dump($v->room->toArray());
    }
});

# 预加载多个相关
Route::get('/try/preload/students', function() {
    $data = \App\Models\Student::with('room','images')->get();
    var_dump($data->toArray());
});

# 嵌套预加载
Route::get('/try/preload/roomimages', function() {
    $data = \App\Models\Room::with('students.images')->find(1)->toArray();
    var_dump($data);
});

Route::get('/try/preload/search', function() {
    $data = \App\Models\Room::with(['students' => function($query){
        $query->where('name', '野原新之助');
    }])->get()->toArray();
    var_dump($data);
});