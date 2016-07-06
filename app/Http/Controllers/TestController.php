<?php
/**
 * Created by PhpStorm.
 * User: silov
 * Date: 16/5/27
 * Time: 10:52
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class TestController extends BaseController
{
    public function index()
    {
        echo "xxx";
    }

    public function getGet($id = 0)
    {
        echo $id;
    }

    public function getShow()
    {
        $data = [
            'name'  => 'Silov.Yu',
            'title'    => 'My LaravelCookbook'
        ];
        return view('test.show', $data);
    }

    public function getForm()
    {
        return view('test.form');
    }

    public function postWhat(Request $request)
    {
        var_dump($request->get('name'));
    }
}