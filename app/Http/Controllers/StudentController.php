<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StudentController extends Controller
{
    public function getIndex()
    {
        echo "Student.Index";
    }

    public function getList()
    {
        echo "List";
    }

    public function getAddv()
    {
        return view("student.addv");
    }
}
