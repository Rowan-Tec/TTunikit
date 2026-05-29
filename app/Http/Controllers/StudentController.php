<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function info(){
        return view('wil_module.student.wil_info');
    }

    public function payment()
    {
        $application = Auth::user()->WilApplication;

        return view('wil_module.student.payment',compact('application'));
    }
}
