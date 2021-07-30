<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MiscMst;
use App\Models\UserRole;



class CustomerController extends Controller
{
    public function __construct() 
	{ 
        $this->User = new User;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "Customer List"; 
        $customer = $this->User->user_list($request->user_code, $request->name);  
        $data = compact('title','customer','request');
        return view('admin.customer.customer_list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $title              = "Customer Create";
        $data               = compact('title');
        return view('admin.customer.customer_create', $data); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record_data        = User::findOrfail(base64_decode($id));   
        $title              = "Edit Customer";
        $data               = compact('title','record_data');
        return view('admin.customer_create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $emp_id = base64_decode($id); 
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
		];

		$validatedData = $request->validate([
			'name' 	    		=> 'required|min:3|max:30',
			'phone' 			=> 'required|unique:users,phone',
			'email' 			=> 'required|max:50|unique:users,email|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^', 
			 
        ], $error_message);
 
        if($emp_id == 0)
        { 
            if($emp_id != 0)
            {
                $validatedData[] = $request->validate([
                    'password'			=> 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                    'confirm_password'	=> 'required|required_with:password|same:password',
                ], $error_message);
            } 
        }
        try
		{
            
            if($emp_id == 0)
            { 
                \DB::beginTransaction();
				$user = new User();
				$user->fill($request->all());
				$user->password = md5($request->password);
				$user->email_status = config('constant.MAIL_STATUS.VERIFIED');
				$user->phone_status = config('constant.MAIL_STATUS.VERIFIED');
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
                return redirect()->route('customers.index')->with('Success','Customer created successfully');
            }
            else
            {
                \DB::beginTransaction(); 
                Employee::findOrFail($emp_id)->update($request->all());
                \DB::commit();
                return redirect()->route('customers.index')->withInput($request->all())->with('Success','Customer updated successfully');
            }
        }
        catch (\Throwable $e)
    	{
            \DB::rollback();
            return back()->with('Failed',$e->getMessage())->withInput();
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        User::findOrfail(base64_decode($id))->delete();
        return redirect()->route('customers.index')->with('Success','Customer deleted successfully');
    }
}
