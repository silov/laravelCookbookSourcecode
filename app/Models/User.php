<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 判断用户名密码是否可以登录
     * @param $username
     * @param $password
     * @return int
     */
    public function login($username, $password)
    {
        $user = $this->where('username', $username)->first();
        if (empty($user)) {
            return 404;
        }

        if (Hash::check($password, $user->password)) {
            Session::set('user_id', $user->id);
            return 200;
        } else {
            return 300;
        }
    }

    /**
     * 新增用户
     * @param $username
     * @param $password 原始密码
     * @param $nickname
     * @param $email
     * @return array
     */
    public function registerUser($username, $password, $nickname, $email)
    {
        $user = new User;

        $user->username = $username;
        $user->password = bcrypt($password);
        $user->nickname = $nickname;
        $user->email    = $email;
        $user->save();

        return $user->toArray();
    }
}
