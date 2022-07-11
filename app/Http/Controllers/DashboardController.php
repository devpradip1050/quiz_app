<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function result()
    {
        $results = Result::all();
        return view('admin.result')->with(['results'=>$results]);
    }
}
