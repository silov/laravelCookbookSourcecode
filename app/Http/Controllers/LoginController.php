<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Login Page
     */
    public function getLogin()
    {
        return view('login.login');
    }

    /**
     * Login Logic
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postLogin(Request $request)
    {
        $params = $request->all();
        if (Auth::attempt(['username'   => $params['username'],'password' => $params['password']])) {
            echo "success";
        } else {
            echo "faild";
        }
//        $rules = [
//            'username'  => 'required|between:5,20',
//            'password'  => 'required|between:5,20'
//        ];
//
//        $messages = [
//            'username.required' => '用户名不能为空',
//            'username.between'  => '用户名长度应为5~20位',
//            'password.required' => '密码不能为空',
//            'password.between'  => '密码长度应为5~20位',
//        ];
//        $this->validate($request, $rules, $messages);
//
//        $params = $request->all();
//        $userModel = new User();
//        $code = $userModel->login($params['username'], $params['password']);
//        if ($code == 200) {
//            echo session('user_id');
//            //return redirect('student/list');
//            exit;
//        } else {
//            $msg = ($code == 404) ? '用户名不存在' : '密码错误';
//            return redirect('login/login')->with('err',$msg);
//        }
    }

    public function getRegister()
    {
        $model = new User();
        $user = $model->registerUser('admin','admin2016','超级管理员','admin@flaravel.me');
        var_dump($user);
    }
}
