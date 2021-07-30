<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Validator;
use App\Http\Controllers\ApiController\BaseController as BaseController;
use App\Models\User;
use App\Models\Designation;
use App\Models\Feedback;
use App\Http\Resources\Designation as DesignationArtical;
use App\Http\Resources\CustomerProfile;
use App\Http\Resources\Expert; 
use App\Http\Resources\Feedback as FeedbackArtical;
use Hash;
use DB;

class CommonController extends BaseController
{
	public function __construct() 
	{
		$this->User = new User; 
	}

	public function login_account(Request $request)
	{
		$error_message = 	[
			'user_name.required' 	=> 'Email address / Mobile number should be required',
			'password.required' 	=> 'Password should be required',
            'password.min'         => 'Password minimun lenght :min characters',
            'password.max'         => 'Password maximum lenght :max characters',
            'password.regex'       => 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
		];

		$rules = [
			'user_name' 	=> 'required',
			'password' 	=> 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
		];
		
        $validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed(['errors' =>$validator->errors()], 200);       
        }

		try
		{
			$user_exist = $this->User->login_account($request->user_name, md5($request->password), $user_data);
			if($user_exist)
			{ 
				$otp = rand(1111,9999);
				$details = array(
					'name'         	=> $user_data->name,
					'mobile' 		=> $user_data->phone,
					'email' 		=> $user_data->email,    
					'user_id'       => $user_data->user_id,
					'otp'			=> $otp,
				);   
				
				
				if($user_data->email_status != config('constant.MAIL_STATUS.VERIFIED')){ 
					\Mail::to($user_data->email)->send(new \App\Mail\OTPMail($details));
                    return $this->sendSuccess(['user_id' => $user_data->user_id, 'otp' => $otp],'Your email has not been verified yet');
                }else{ 
					if($user_data->user_role->role_id == 3){
						$user_data = new CustomerProfile($user_data); 
					}
					$login_token = $this->createLoginToken();
					$data = ['user_data'=>$user_data,'role'=>$user_data->user_role->role_id,'login_token'=>$login_token];
					return $this->sendSuccess($data, 'Logged in successfully');
				}
			}
			else
			{
				return $this->sendFailed('We could not found any account with that info',200);  
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	 public function createLoginToken()
    {
        $length = 40;
        $token = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!@#$%^&*()_+', ceil($length / strlen($x)))), 1, $length);
        return $token;
    }
    
	public function resend_otp(Request $request)
	{ 
		$error_message = 	[
			'email.required' 	=> 'Email address should be required',
		];

		$rules = [
			'email' 	=> 'required',
		];

		$validator = Validator::make($request->all(), $rules, $error_message);
		
		if($validator->fails()){
            return $this->sendFailed(['errors' =>$validator->errors()], 200);       
        }

		try
		{
			$user_data = User::where('email',$request['email'])->first();
			$otp = rand(1111,9999);
			$details = array(
				'name'         	=> $user_data->name,
				'mobile' 		=> $user_data->phone,
				'email' 		=> $user_data->email,    
				'user_id'       => $user_data->user_id,
				'otp'			=> $otp,
			);   
			
			\Mail::to($user_data->email)->send(new \App\Mail\OTPMail($details));

			return $this->sendSuccess(['user_id'=>$user_data->user_id,'mobile_otp' => $otp], 'OTP sent successfully');
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function change_password(Request $request)
	{
		$error_message = 	[
			'user_id.required' 			=> 'User Id should be required',
			'old_password.required' 	=> 'Old password should be required',
			'new_password.required' 	=> 'New password should be required',
			'confirm_password.required' => 'Confirm password should be required',
            'new_password.min'         	=> 'Password minimun lenght :min characters',
            'new_password.max'         	=> 'Password maximum lenght :max characters',
            'new_password.regex'       	=> 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
            'same'                      => 'Confirm password should be same as new password',
            'different'                 => 'New password should not be same as previous password'
		];

		$rules = [
			'user_id'			=> 'required',
			'old_password'		=> 'required',
			'new_password'		=> 'required|min:8|max:16|different:old_password|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirm_password'	=> 'required|required_with:new_password|same:new_password',
		];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed(['errors' =>$validator->errors()], 200);       
        }

		try
		{ 
				$user_count = User::where('user_id',$request->user_id)->where('password',md5($request->old_password))->count();
				
				if($user_count > 0)
				{
					// $request['user_password'] = md5($request->new_password);
					$user = User::where('user_id',$request->user_id)->update(['password'=>md5($request->new_password)]); 
					return $this->sendSuccess('', 'Password update successfully');
				}
				else
				{
					return $this->sendFailed('Invalid old password', 200);
				} 
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function forgot_password(Request $request)
	{
		$error_message = 	[
			'email.required' 	=> 'Email address should be required',
		];

		$rules = [
			'email' 	=> 'required',
		];
		
        $validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed(['errors' =>$validator->errors()], 200);       
        }

		try
		{
			$emailExist	= User::where('email',$request['email'])->first(); 
			if(!empty($emailExist)){  
				//mail to new subadmin
				$otp = rand(1111,9999);
				$details = [
					'name'         => $emailExist->name,
					'phone' 		=>  $emailExist->phone,
					'email' 		=> $emailExist->email,  
					'userId'       => $emailExist->user_id,
					'otp'		=> $otp,
				]; 
				\Mail::to($request['email'])->send(new \App\Mail\ForgotPasswordMail($details));  
 
				return $this->sendSuccess(['user_id' => $emailExist->user_id, 'otp' => $otp ], 'Please check your email for password reset link & reset your password');
			} 
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function reset_password(Request $request)
	{
		$error_message = 	[
			'user_id.required' 			=> 'User Id should be required',
			'new_password.required' 	=> 'New password should be required',
			'confirm_password.required' => 'Confirm password should be required',
            'new_password.min'         	=> 'Password minimun lenght :min characters',
            'new_password.max'         	=> 'Password maximum lenght :max characters',
            'new_password.regex'       	=> 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
            'same'                      => 'Confirm password should be same as new password',
            'different'                 => 'New password should not be same as previous password'
		];

		$rules = [
			'user_id'			=> 'required',
			'new_password'		=> 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirm_password'	=> 'required|required_with:new_password|same:new_password',
		];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed(['errors' =>$validator->errors()], 200);       
        }

		try
		{ 
			$user_data = User::find($request->user_id);
			if(isset($user_data))
			{  
				$password = ['password' => md5($request['new_password'])]; 
				User::where('user_id',$request->user_id)->update(['password' => md5($request['new_password'])]);   
				return $this->sendSuccess('', 'Password updated Successfully');
			 
			}
			else
			{
				return $this->sendFailed('Invalid access', 200);       
			} 
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function verify_account(Request $request)
	{
		$error_message 	= 	[
			'user_id.required' 			=> 'User Id should be required',  
		];
		$rules 			= 	[ 
			'user_id'			=> 'required', 
		];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed(['errors' =>$validator->errors()], 200);       
        }

		try
		{
			\DB::beginTransaction();  
			$user = User::where('user_id',$request->user_id)->update(['email_status'=>config('constant.MAIL_STATUS.VERIFIED'),'phone_status'=>config('constant.MAIL_STATUS.VERIFIED')]);  
			\DB::commit(); 
			$user_data = new CustomerProfile(User::findOrfail($request->user_id));
			return $this->sendSuccess('', 'Status updated successfully'); 
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}
}