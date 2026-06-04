<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\WilApplication;

class StudentController extends Controller
{
     public function index()
{
   $application = Auth::user()->wilApplication;

    dd($application); 

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


    public function payment($id)
    {

        $application = WilApplication::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->first();

    if (!$application) {
        return redirect()->route('dashboard')
            ->with('error', 'You need a WIL application before making a payment.');
    }

        return view('wil_module.student.payment',compact('application'));
    }
}
