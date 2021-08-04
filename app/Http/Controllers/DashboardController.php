<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function homeIndex(){
        $title = 'Dashboard';
        $data = compact('title');
        return view('admin.dashboard', $data);
    }
}
