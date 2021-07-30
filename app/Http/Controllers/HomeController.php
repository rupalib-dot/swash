<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Password;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Blog;
use App\Models\Banner;
use Session;
use App\Models\Questionnaire; 
use App\Models\QuestionChoices; 
use DB;
use App\Models\UserResponces;
use Auth;

class HomeController extends Controller
{
    public function home_index()
    { 
        $title          = "Home";
        $data           = compact('title');
        return view('home', $data);
    }

    public function login_index()
    {
        if(Auth::check()) :
            return redirect()->route('dashboard');
        else :
            $title  = "Login Account";
            $data   = compact('title');
            return view('admin.login', $data);
        endif;
    }

    public function login_user(Request $request)
    {
        $error_message = 	[
			'user_name.required' 		    => 'User Name should be required',
			'password.required' 	        => 'Password required',
			'password.regex' 			=> 'Provide password in valid format',
		];

		$rules = [
			'user_name' 	    => 'required',
			'password' 	=> 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
		];

        $this->validate($request, $rules, $error_message);

        try
        {
            if(Auth::attempt(['user_name' => $request->user_name, 'password' => $request->password]))
            {
                return redirect()->route('dashboard');
            }
            return redirect()->back()->With('Failed', 'Invalid login details')->withInput($request->only(['user_name']));
        }
        catch(\Throwable $e)
        {
            return redirect()->back()->With('Failed', $e->getMessage());
        }
    }

    public function generate_token(Request $request)
    {
        $error_message = 	[
			'required' 		=> 'Email address should be required',
			'regex' 	    => 'Provide valid email address',
		];

		$rules = [
			'email' => 'required|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
		];

        $this->validate($request, $rules, $error_message);

        $count_rec = User::where('email',$request->email)->count();
        if($count_rec > 0)
        {
            $password = new Password;
            $password->email        = $request->email;
            $password->token        = str::random(64);
            $password->created_at   = Carbon::now();
            $password->save();
            return redirect('admin')->with('Success', 'Verifaction link sent on your email');
        }
        return back()->with('Failed', 'We could not found account with that email address')->withInput();
    }

    public function forgot_password()
    {
        $title  = "Forgot Password";
        $data   = compact('title');
        return view('admin.forget_password', $data);
    }

    
    public function verify_account(Request $request){
        $email 	= base64_decode($request['email']);
		$userId 	= base64_decode($request['userId']); 
		
		if(!empty($email) && !empty($userId))
		{
			try
			{  
                $emailExist = User::where(['user_id'=>$userId,'email_address'=>$email])->first();
                if(!$emailExist)
                {
                    return redirect('user_login')->with('Failed', 'Unauthorized Access...');
                }
                else
                {
                    $nRow =User::where('user_id',$userId)->update(['email_status'=>config('constant.MAIL_STATUS.VERIFIED'),'phone_status'=>config('constant.MAIL_STATUS.VERIFIED'),'updated_at'=>date('Y-m-d H:i:s')]);
                    return redirect('user_login')->with('Success', 'Your account has been verified successfully.Please login using your email and password');
                } 
			}
			catch(\Exception $e)
			{
				return redirect('user_login')->with('Failed', $e->getMessage().' on Line '.$e->getLine());
			}
		}
		else
		{
			return redirect('user_login')->with('Failed', 'Unauthorized Access...');
		}
    }
  
}
