<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){

    }
    public function dashboard(){
        return view('auth.dashboard');
    }
}
