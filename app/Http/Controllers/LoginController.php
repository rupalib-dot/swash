<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->Users = new User;
    }
    public function loginPage()
    {
        if(!session()->has('ADMIN_ID')) :
            $title  = "Login Account";
            $data   = compact('title');
            return view('login', $data);
        else :
            return redirect()->route('dashboard');
        endif;
    }
    public function loginSubmit(Request $request)
    {
        $rules = [
            'email'     => 'required|max:50|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
            'password'     => 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ];

        $this->validate($request, $rules);
        try {
            $data = $this->Users->checkUser($request->email, md5($request->password));
            if (isset($data)) {
                // $token = $data->token;
                // if($token){
                //     return redirect()->back()->with('Failed', 'Your Are login other browser')->withInput();
                // }
                // else{
                    //User::where('id', $data->id)->update(['token' => uniqid()]);
                    session(['ADMIN_ID' => $data->id]);
                    return redirect()->route('dashboard');
                // }

            } else {
                return redirect()->back()->with('Failed', 'Invalid login credentials')->withInput();
            }
        } catch (\Throwable $e) {
            return redirect()->back()->With('Failed', $e->getMessage());
        }
    }
    public function logoutAdmin()
    {
        //User::where('id',session('ADMIN_ID'))->update(['token' => null]);
        session::forget('ADMIN_ID');
        return redirect()->route('login')->with('Success', 'Logout successfully');
    }
}
