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
        $error_message =     [
            'email.required'     => 'Email address should be required',
            'password.required'     => 'Password should be required',
            'password.min'         => 'Password minimun lenght :min characters',
            'password.max'         => 'Password maximum lenght :max characters',
            'password.regex'       => 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
        ];

        $rules = [
            'email'     => 'required|max:50|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
            'password'     => 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ];

        $validator = Validator::make($request->all(), $rules, $error_message);

        if ($validator->fails()) {
            return $this->sendFailed(['errors' => $validator->errors()], 200);
        }

        try {
            $user_exist = $this->User->checkUser($request->email, md5($request->password));
            if ($user_exist) {
                $otp = rand(1111, 9999);
                $details = array(
                    'name'             => $user_exist->name,
                    'mobile'         => $user_exist->phone,
                    'email'         => $user_exist->email,
                    'id'            => $user_exist->id,
                    'otp'            => $otp,
                );
                if ($user_exist->verify == null) {
                    \Mail::to($user_exist->email)->send(new \App\Mail\OTPMail($details));
                    return $this->sendSuccess(['id' => $user_exist->id, 'otp' => $otp, 'email' =>  $user_exist->email], 'Your email has not been verified yet');
                } else {
                    if ($user_exist->role == 'client' || $user_exist->status == 'active') {
                        $data = ['user_data' => $user_exist, 'role' => $user_exist->role, 'login_token' => uniqid()];
                        return $this->sendSuccess($data, 'Logged in successfully');
                    } else {
                        return $this->sendFailed('We could not found any account with that info', 200);
                    }
                }
            } else {
                return $this->sendFailed('We could not found any account with that info', 200);
            }
        } catch (\Throwable $e) {
            return $this->sendFailed($e->getMessage() . ' on line ' . $e->getLine(), 400);
        }
    }

    public function resend_otp(Request $request)
    {
        $error_message =     [
            'email.required'     => 'Email address should be required',
        ];
        $rules = [
            'email'     => 'required',
        ];
        $validator = Validator::make($request->all(), $rules, $error_message);

        if ($validator->fails()) {
            return $this->sendFailed(['errors' => $validator->errors()], 200);
        }

        try {
            $user_data = User::where('email', $request['email'])->first();
            $otp = rand(1111, 9999);
            $details = array(
                'name'             => $user_data->name,
                'mobile'         => $user_data->phone,
                'email'         => $user_data->email,
                'id'       => $user_data->id,
                'otp'            => $otp,
            );

            \Mail::to($user_data->email)->send(new \App\Mail\OTPMail($details));

            return $this->sendSuccess(['id' => $user_data->id, 'otp' => $otp, 'email' => $user_data->email], 'OTP sent successfully');
        } catch (\Throwable $e) {
            return $this->sendFailed($e->getMessage() . ' on line ' . $e->getLine(), 400);
        }
    }

    public function change_password(Request $request)
    {
        $error_message =     [
            'id.required'             => 'User Id should be required',
            'old_password.required'     => 'Old password should be required',
            'new_password.required'     => 'New password should be required',
            'confirm_password.required' => 'Confirm password should be required',
            'new_password.min'             => 'Password minimun lenght :min characters',
            'new_password.max'             => 'Password maximum lenght :max characters',
            'new_password.regex'           => 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
            'same'                      => 'Confirm password should be same as new password',
            'different'                 => 'New password should not be same as previous password'
        ];

        $rules = [
            'id'            => 'required',
            'old_password'        => 'required',
            'new_password'        => 'required|min:8|max:16|different:old_password|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirm_password'    => 'required|required_with:new_password|same:new_password',
        ];

        $validator = Validator::make($request->all(), $rules, $error_message);

        if ($validator->fails()) {
            return $this->sendFailed(['errors' => $validator->errors()], 200);
        }

        try {
            $user_count = User::where('id', $request->id)->where('password', md5($request->old_password))->count();

            if ($user_count > 0) {
                // $request['user_password'] = md5($request->new_password);
                $user = User::where('id', $request->id)->update(['password' => md5($request->new_password)]);
                return $this->sendSuccess('', 'Password update successfully');
            } else {
                return $this->sendFailed('Invalid old password', 200);
            }
        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->sendFailed($e->getMessage() . ' on line ' . $e->getLine(), 400);
        }
    }

    public function forgot_password(Request $request)
    {
        $error_message =     [
            'email.required'     => 'Email address should be required',
        ];

        $rules = [
            'email'     => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $error_message);

        if ($validator->fails()) {
            return $this->sendFailed(['errors' => $validator->errors()], 200);
        }

        try {
            $emailExist    = User::where('email', $request['email'])->first();
            if (!empty($emailExist)) {
                //mail to new subadmin
                $otp = rand(1111, 9999);
                $details = [
                    'name'         => $emailExist->name,
                    'phone'         =>  $emailExist->phone,
                    'email'         => $emailExist->email,
                    'id'       => $emailExist->id,
                    'otp'        => $otp,
                ];
                \Mail::to($request['email'])->send(new \App\Mail\ForgotPasswordMail($details));

                return $this->sendSuccess(['id' => $emailExist->id, 'otp' => $otp, 'email' => $emailExist->email, 'reset_token' => uniqid()], 'Please check your email for password reset link & reset your password');
            }
        } catch (\Throwable $e) {
            return $this->sendFailed($e->getMessage() . ' on line ' . $e->getLine(), 400);
        }
    }

    public function reset_password(Request $request)
    {
        $error_message =     [
            'id.required'             => 'User Id should be required',
            'new_password.required'     => 'New password should be required',
            'confirm_password.required' => 'Confirm password should be required',
            'new_password.min'             => 'Password minimun lenght :min characters',
            'new_password.max'             => 'Password maximum lenght :max characters',
            'new_password.regex'           => 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
            'same'                      => 'Confirm password should be same as new password',
            'different'                 => 'New password should not be same as previous password'
        ];

        $rules = [
            'id'            => 'required',
            'new_password'        => 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirm_password'    => 'required|required_with:new_password|same:new_password',
        ];

        $validator = Validator::make($request->all(), $rules, $error_message);

        if ($validator->fails()) {
            return $this->sendFailed(['errors' => $validator->errors()], 200);
        }

        try {
            $user_data = User::find($request->id);
            if (isset($user_data)) {
                $password = ['password' => md5($request['new_password'])];
                User::where('id', $request->id)->update(['password' => md5($request['new_password'])]);
                return $this->sendSuccess('', 'Password updated Successfully');
            } else {
                return $this->sendFailed('Invalid access', 200);
            }
        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->sendFailed($e->getMessage() . ' on line ' . $e->getLine(), 400);
        }
    }

    public function verify_account(Request $request)
    {
        $error_message     =     [
            'id.required'             => 'User Id should be required',
        ];
        $rules             =     [
            'id'            => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $error_message);

        if ($validator->fails()) {
            return $this->sendFailed(['errors' => $validator->errors()], 200);
        }

        try {
            \DB::beginTransaction();
            $user = User::where('id', $request->id)->update(['verify' => true]);
            \DB::commit();
            $user_data = new CustomerProfile(User::findOrfail($request->id));
            return $this->sendSuccess('', 'Status updated successfully');
        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->sendFailed($e->getMessage() . ' on line ' . $e->getLine(), 400);
        }
    }
}
