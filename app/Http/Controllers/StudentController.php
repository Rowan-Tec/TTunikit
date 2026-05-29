<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function info(){
        return view('wil_module.student.wil_info');
    }
}
