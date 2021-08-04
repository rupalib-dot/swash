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
            'same'                      => 'Confirm password did not matched'
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
                $user->role = 'client';
                $user->status = 'active';
				$user->save();
				$userId =$user->id;
				$otp = rand(1111,9999);
				$details = array(
					'name'         	=> $request->name,
					'mobile' 		=> $request->phone,
					'email' 		=> $request->email,
					'password'      => $request->password,
					'id'       => $userId,
					'otp'			=> $otp,
				);
				\Mail::to($request->email)->send(new \App\Mail\NewUserMail($details));

			\DB::commit();
			return $this->sendSuccess(['id' => $userId, 'otp' => $otp, 'email' => $request->email ], 'OTP sent on your mobile number');
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);
    	}
	}

	public function update(Request $request, $id)
	{
		$error_message = 	[
			'name.required' 	    => 'Full name should be required',
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
			'phone' 	=> 'required|digits:10|unique:users,phone,'.$id.',id',
			'email' 	=> 'required|max:50|unique:users,email,'.$id.',id|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
		];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed(['errors' =>$validator->errors()], 200);
        }

		try
		{
			\DB::beginTransaction();
				User::findOrfail($id)->update($request->all());
				$user_data = new CustomerProfile(User::findOrfail($id));
			\DB::commit();
			return $this->sendSuccess($user_data, 'Profile updated successfully');
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);
    	}
	}

	public function show($id)
	{
		try
		{
			$user_data = User::find($id);
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
