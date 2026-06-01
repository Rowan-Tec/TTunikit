<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
     public function index()
{
    $application = Auth::user()->WilApplication;  

    return view('dashboard',compact('application'));
}
    public function info(){
        return view('wil_module.student.wil_info');
    }

    public function status()
{
    $application = Auth::user()->WilApplication;  

    return view('wil_module.student.status_track',compact('application'));
}


    public function payment()
    {
        $application = Auth::user()->WilApplication;

        return view('wil_module.student.payment',compact('application'));
    }
}
