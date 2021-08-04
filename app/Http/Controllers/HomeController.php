<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homeIndex(){
        $title = 'Login';
        $data = compact('title');
        return view('home');
    }
}
