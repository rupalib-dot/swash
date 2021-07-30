<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Validator;
use App\Http\Controllers\ApiController\BaseController as BaseController;
use App\Models\User;
use App\Models\UserRole;
use App\Http\Resources\CustomerProfile;
use Mail;
use Hash;
use DB;

class CustomerController extends BaseController
{
	public function __construct() 
	{ 
	}
	
	public function store(Request $request)
	{
		$error_message = 	[
			'name.required' 	    	=> 'Full name should be required', 
            'phone.required' 			=> 'Mobile number should be required',
			'email.required' 			=> 'Email address should be required',
			'password.required' 		=> 'Password should be required',
			'confirm_password.required' => 'Confirm password should be required',
			'phone.unique' 				=> 'Mobile number already exist',
			'email.unique' 				=> 'Email address already exist',
			'name.min' 					=> 'Full name minimum :min characters',
			'name.max' 					=> 'Full name maximum :max characters',
			'email.max' 				=> 'Email address maximum :max characters',
			'email.regex' 				=> 'Provide valid email address',
            'password.min'         		=> 'Password minimun lenght :min characters',
            'password.max'        		=> 'Password maximum lenght :max characters',
            'password.regex'       		=> 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
            'same'                      => 'Confirm password did not matched',
            'accepted'                  => 'Accept terms & conditions',
		];

		$rules = [
			'name' 	    		=> 'required|min:3|max:30',
			'phone' 			=> 'required|digits:10|unique:users,phone',
			'email' 			=> 'required|max:50|unique:users,email|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^', 
			'password'			=> 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirm_password'	=> 'required|required_with:password|same:password',
		];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){  
            return $this->sendFailed(['errors' =>$validator->errors()], 200);       
        }

		try
		{
			\DB::beginTransaction();
				$user = new User();
				$user->fill($request->all());
				$user->password = md5($request->password);
				$user->email_status = config('constant.MAIL_STATUS.UNVERIFIED');
				$user->phone_status = config('constant.MAIL_STATUS.UNVERIFIED');
				$user->user_code = strtoupper(substr($request->name, 0, 2)."-".rand(11111,99999));
				$user->save(); 
				$userId =$user->user_id;

				$user_role = new UserRole;
                $user_role->role_id = 3;
                $user_role->user_id = $userId;
                $user_role->save();

				$otp = rand(1111,9999);
				$details = array(
					'name'         	=> $request->name,
					'mobile' 		=> $request->phone,
					'email' 		=> $request->email,   
					'password'      => $request->password,
					'user_id'       => $userId,
					'otp'			=> $otp,
				);   
				\Mail::to($request->email)->send(new \App\Mail\NewUserMail($details));

			\DB::commit();
			return $this->sendSuccess(['user_id' => $userId, 'otp' => $otp ], 'OTP sent on your mobile number');
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function update(Request $request, $user_id)
	{ 
		$error_message = 	[
			'name.required' 	    => 'Full name should be required',
			//'gender.required' 	    => 'Gender should be required',
			//'dob.required' 	        => 'DOB should be required',
			//'country_id.required'   => 'Country should be required',
			//'state_id.required'     => 'State should be required',
			//'city_id.required' 	    => 'City should be required',
			//'dob.required' 	        => 'DOB should be required',
            'phone.required' 	    => 'Mobile number should be required',
			'email.required' 	    => 'Email address should be required',
			'phone.unique' 		    => 'Mobile number already exist',
			'email.unique' 		    => 'Email address already exist',
			'name.min' 			    => 'Full name minimum :min characters',
			'name.max' 			    => 'Full name maximum :max characters',
			'email.max' 		    => 'Email address maximum :max characters',
			'email.regex' 		    => 'Provide valid email address',
		];

		$rules = [
			'name' 	    => 'required|min:3|max:30',
			'phone' 	=> 'required|digits:10|unique:users,phone,'.$user_id.',user_id',
			'email' 	=> 'required|max:50|unique:users,email,'.$user_id.',user_id|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
			//'gender' 	    => 'required',
			//'country_id' 	    => 'required',
			//'state_id' 	        => 'required',
			//'city_id' 	        => 'required',
			//'dob' 	        => 'required',
		];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed(['errors' =>$validator->errors()], 200);       
        }

		try
		{
			\DB::beginTransaction();
				User::findOrfail($user_id)->update($request->all());
				$user_data = new CustomerProfile(User::findOrfail($user_id));
			\DB::commit();
			return $this->sendSuccess($user_data, 'Profile updated successfully');
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function show($user_id)
	{
		try
		{
			$user_data = User::find($user_id);
			if(isset($user_data))
			{
				$user_data = new CustomerProfile($user_data);
				return $this->sendSuccess($user_data, 'Profile listed successfully');
			}
			else
			{
				return $this->sendFailed('Unauthorized access',200);  
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}
}