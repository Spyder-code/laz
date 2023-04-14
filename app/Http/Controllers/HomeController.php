<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id==1) {
            return redirect()->route('donatur.index');
        } else {
            return redirect()->route('user.show',Auth::user());
        }

    }
}
