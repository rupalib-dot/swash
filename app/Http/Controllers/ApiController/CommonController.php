<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Validator;
use App\Http\Controllers\ApiController\BaseController as BaseController;
use App\Models\User;
use App\Models\Setting;
use App\Models\Locations;
use App\Models\Blackout;
use App\Models\Cart;
use App\Models\Booking;
use App\Models\Coupons;
use App\Models\UsedCoupon;
use App\Models\ReferralCoupon;
use App\Models\Reschedule;

use App\Http\Resources\CustomerProfile;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;
use Illuminate\Support\Facades\Http;
use App\Models\Order;

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

            \Mail::to($user_data->email)->send(new \App\Mail\ResendOtp($details));

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

                return $this->sendSuccess(['id' => $emailExist->id, 'otp' => $otp, 'email' => $emailExist->email, 'reset_token' => uniqid()], 'Please check your email for password reset OTP & reset your password');
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
            'id.required'  => 'User Id should be required',
        ];
        $rules             =     [
            'id' => 'required',
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

    public function application_setting()
    {
        $setting = Setting::where('id', 1)->first();
        return $this->sendSuccess($setting, 'All setting');
    }

    public function locations()
    {
        $locations = Locations::OrderBy('id', 'DESC')->get();
        return $this->sendSuccess($locations, 'All Location');
    }

    public function checkAbility(Request $request)
    {
        // car_plate: car_plate, car_brand: car_brand, carpark_add: carpark_add, mobile_number:mobile_number
        $rules = [
            'user_id' => 'required',
            'date' => 'required',
            'location' => 'required',
            'car' => 'required',
            'car_plate' => 'required',
            'car_brand' => 'required',
            'carpark_add' => 'required',
            'mobile_number' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendFailed(['errors' => $validator->errors()], 200);
        }
        $request['date'] = date("m/d/Y", strtotime($request->date));
        try {

            //Check Blank Date
            $blankdates = Blackout::where('location', $request->location)->get();
            if (count($blankdates) > 0) {
                foreach ($blankdates as $blankdate) {
                    $startDate = date_create($blankdate->startdate);
                    $startDateFormat = date_format($startDate, 'm/d/Y');
                    $endDate = date_create($blankdate->enddate);
                    $endDateFormat = date_format($endDate, 'm/d/Y');
                }
                $allDates = array();
                $period = new DatePeriod(
                    new DateTime($startDateFormat),
                    new DateInterval('P1D'),
                    new DateTime($endDateFormat)
                );
                foreach ($period as $key => $value) {
                    $allDates[] = $value->format('m/d/Y');
                }
                $matchDate = false;
                if (in_array($request->date, $allDates)) {
                    $matchDate = true;
                }
                if ($matchDate) {
                    return $this->sendFailed(['logicError' => 'Sorry, We are on Holiday on this date at this location'], 200);
                }
            }
            // check Location Capacity
            $locations = Locations::where('id', $request->location)->first();
            $locationscapacity = $locations->capacity;
            $matchThese = ['location' => $request->location, 'date' => $request->date];
            $checkcart = Cart::where($matchThese)->get();
            $checkbooking = Booking::where('location', $request->location)->where('date', $request->date)->get();

            if (count($checkbooking) >= $locationscapacity) {
                return $this->sendFailed(['logicError' => 'All slots booked in this location'], 200);
            } else {
                if (count($checkcart) >= $locationscapacity) {
                    return $this->sendFailed(['logicError' => 'Booking Capacity is completed for this date and location, Plz choose another date'], 200);
                }
                $plusCart = count($checkbooking) + count($checkcart);
                if ($plusCart >= $locationscapacity) {
                    return $this->sendFailed(['logicError' => 'waiting list' . count($checkcart)], 200);
                } else {
                    $setting = Setting::where('id', 1)->first();

                    $checkdate =  Cart::where('user_id', $request->user_id)->where('date', $request['date'])->get();
                    if (count($checkdate) > 0) {
                        return $this->sendFailed(['logicError' => 'You can wash one car on One Date. Please change the date'], 200);
                    }
                    \DB::beginTransaction();
                    $request['location_name'] = getLocationName($request->location);
                    $insertCart = new Cart();
                    $insertCart->fill($request->all());
                    $insertCart->save();
                    $allCartvalue =  Cart::where('user_id', $request->user_id)->get();
                    \DB::commit();
                    $sessionMsg = '';
                    if (count($allCartvalue) >= $setting->auto_discount_2) {
                        $sessionMsg = 'Your ' . count($allCartvalue) . ' session is added in cart. ' . $setting->auto_discount_percent_2 . '% off! *Discount applies automatically at check-out';
                    } elseif (count($allCartvalue) >= $setting->auto_discount_1) {
                        $sessionMsg = 'Your ' . count($allCartvalue) . ' session is added in cart. ' . $setting->auto_discount_percent_1 . '% off! *Discount applies automatically at check-out';
                    } else {
                        $sessionMsg = 'Your ' . count($allCartvalue) . ' session is added in cart';
                    }
                    return $this->sendSuccess(['cart' => $sessionMsg, 'car_type' => $request->car], 'Status updated successfully');
                }
            }
        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->sendFailed(['logicError' => $e->getMessage() . ' on line ' . $e->getLine()], 400);
        }
    }

    public function cartvalue(Request $request)
    {
        $rules = [
            'user_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendFailed(['errors' => $validator->errors()], 200);
        }
        try {
            $cartRow = Cart::where('user_id', $request->user_id)->OrderBy('id', 'DESC')->get();
            if (count($cartRow) > 0) {
                return $this->sendSuccess($cartRow, 'All Location');
            } else {
                $array = 0;
                return $this->sendSuccess($array, 'All Location');
            }
        } catch (\Throwable $e) {
            return $this->sendFailed(['logicError' => $e->getMessage() . ' on line ' . $e->getLine()], 400);
        }
    }
    public function totlePrice(Request $request)
    {
        $rules = [
            'user_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendFailed(['errors' => $validator->errors()], 200);
        }
        $setting = Setting::where('id', 1)->first();
        try {
            $totlePrice = 0;
            $cartRow = Cart::where('user_id', $request->user_id)->OrderBy('id', 'DESC')->get();
            if (count($cartRow) > 0) {
                foreach ($cartRow as $row) {
                    $totlePrice += $row->price;
                }
                if(count($cartRow) >= $setting->auto_discount_1){
                    if(count($cartRow) >= $setting->auto_discount_2){
                        $setting = Setting::where('id', 1)->first();
                        $afterdiscout = $totlePrice - ($setting->auto_discount_percent_2 / 100 * $totlePrice);
                        return $this->sendSuccess(['totle' => number_format((float)$totlePrice, 2, '.', ''), 'payprice' => number_format((float)$afterdiscout, 2, '.', ''), 'autodiscount' => $setting->auto_discount_percent_2], 'All Location');
                    }
                    else{
                        $setting = Setting::where('id', 1)->first();
                        $afterdiscout = $totlePrice - ($setting->auto_discount_percent_1 / 100 * $totlePrice);
                        return $this->sendSuccess(['totle' => number_format((float)$totlePrice, 2, '.', ''), 'payprice' => number_format((float)$afterdiscout, 2, '.', ''), 'autodiscount' => $setting->auto_discount_percent_1], 'All Location');
                    }
                }

                else{
                    return $this->sendSuccess(['totle' => number_format((float)$totlePrice, 2, '.', ''), 'payprice' => number_format((float)$totlePrice, 2, '.', ''), 'autodiscount' => 0], 'All Location');
                }

            } else {
                return $this->sendSuccess(['totleprice' => 0], 'All Location');
            }
        } catch (\Throwable $e) {
            return $this->sendFailed(['logicError' => $e->getMessage() . ' on line ' . $e->getLine()], 400);
        }
    }

    public function applyCoupon(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'coupon' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendFailed(['logicError' => 'Coupon is not Valide'], 400);
        }
        $setting = Setting::where('id', 1)->first();
        try {
            // Check Apply Coupon
            $match = ['coupon_id' => $request->coupon, 'user_id' => $request->user_id];
            $checkApplyCoupon = UsedCoupon::where(['coupon_id' => $request->coupon, 'user_id' => $request->user_id])->get();
            if (count($checkApplyCoupon) > 0) {
                return $this->sendFailed(['logicError' => 'You All ready used this coupon'], 400);
            } else {
                //Check discount coupon
                $dicountcoupon = Coupons::where('name', $request['coupon'])->get();
                $getreferralCoupon = ReferralCoupon::where('user_id', $request['user_id'])->where('coupon', $request['coupon'])->get();
                if (count($dicountcoupon) > 0) {

                    /// Add Discount
                    $totlePrice = 0;
                    $cartRow = Cart::where('user_id', $request->user_id)->OrderBy('id', 'DESC')->get();
                    if (count($cartRow) > 0) {
                        foreach ($cartRow as $row) {
                            $totlePrice += $row->price;
                        }
                    }
                    foreach ($dicountcoupon as $coupon) {
                        $dicount = $coupon->discount;
                    }
                    $remainprice = $totlePrice - ($dicount / 100 * $totlePrice);
                    $insetUsed = new UsedCoupon();
                    $insetUsed->coupon_id = $request['coupon'];
                    $insetUsed->user_id = $request['user_id'];
                    $insetUsed->save();
                    if(count($cartRow) >= $setting->auto_discount_1){
                        if(count($cartRow) >= $setting->auto_discount_2){
                            $afterdiscout = $remainprice - ($setting->auto_discount_percent_2 / 100 * $remainprice);
                            return $this->sendSuccess(['payprice' =>  number_format((float)$afterdiscout, 2, '.', ''), 'discount' => $dicount], 'Your Coupon Successfuly Applied');
                        }
                        else{
                            $afterdiscout = $remainprice - ($setting->auto_discount_percent_1 / 100 * $remainprice);
                            return $this->sendSuccess(['payprice' =>  number_format((float)$afterdiscout, 2, '.', ''), 'discount' => $dicount], 'Your Coupon Successfuly Applied');
                        }
                    }
                    else{
                        return $this->sendSuccess(['payprice' =>  number_format((float)$remainprice, 2, '.', ''), 'discount' => $dicount], 'Your Coupon Successfuly Applied');
                    }

                } elseif (count($getreferralCoupon) > 0) {
                    $setting = Setting::where('id', 1)->first();

                    /// Add Discount
                    $totlePrice = 0;
                    $cartRow = Cart::where('user_id', $request->user_id)->OrderBy('id', 'DESC')->get();
                    if (count($cartRow) > 0) {
                        foreach ($cartRow as $row) {
                            $totlePrice += $row->price;
                        }
                    }
                    $dicount = $setting->loyalty_point_discount;
                    $remainprice = $totlePrice - ($setting->loyalty_point_discount / 100 * $totlePrice);
                    $insetUsed = new UsedCoupon();
                    $insetUsed->coupon_id = $request['coupon'];
                    $insetUsed->user_id = $request['user_id'];
                    $insetUsed->save();
                    if(count($cartRow) >= $setting->auto_discount_1){
                        $afterdiscout = $remainprice - ($setting->auto_discount_percent_1 / 100 * $remainprice);
                        return $this->sendSuccess(['payprice' =>  number_format((float)$afterdiscout, 2, '.', ''), 'discount' => $dicount], 'Your Coupon Successfuly Applied');
                    }
                    elseif(count($cartRow) >= $setting->auto_discount_2){
                        $afterdiscout = $remainprice - ($setting->auto_discount_percent_2 / 100 * $remainprice);
                        return $this->sendSuccess(['payprice' =>  number_format((float)$afterdiscout, 2, '.', ''), 'discount' => $dicount], 'Your Coupon Successfuly Applied');
                    }
                    else{
                        return $this->sendSuccess(['payprice' =>  number_format((float)$remainprice, 2, '.', ''), 'discount' => $dicount], 'Your Coupon Successfuly Applied');
                    }
                } else {
                    return $this->sendFailed(['logicError' => 'Coupon is not Valide'], 400);
                }
            }
        } catch (\Throwable $e) {
            return $this->sendFailed(['logicError' => $e->getMessage() . ' on line ' . $e->getLine()], 400);
        }
    }
    public function removeCart(Request $request)
    {
        $rules = [
            'id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendFailed(['logicError' => 'Coupon is not Valide'], 400);
        }
        try {
            $cartRow = Cart::destroy($request['id']);
            return $this->sendSuccess('', 'All Location');
        } catch (\Throwable $e) {
            return $this->sendFailed(['logicError' => $e->getMessage() . ' on line ' . $e->getLine()], 400);
        }
    }
    public function removecoupon(Request $request)
    {
        try {
            $cartRow = UsedCoupon::where('coupon_id', $request['coupon'])->delete();
            return $this->sendSuccess('', 'All Location');
        } catch (\Throwable $e) {
            return $this->sendFailed(['logicError' => $e->getMessage() . ' on line ' . $e->getLine()], 400);
        }
    }
    public function order(Request $request)
    {
        $ownData = User::where('id',$request->user_id)->first();
        try {

            if($ownData->login_token === null){
                $carts = Cart::where('user_id', $request->user_id)->get();
                \DB::beginTransaction();
                $order = new Order();
                $order->fill($request->all());
                $order->save();
                $orderID  =$order->id;
                $booking = new Booking();
                foreach($carts as $cart){
                    $booking->user_id = $request->user_id;
                    $booking->order_id = $orderID;
                    $booking->date =$cart->date;
                    $booking->car =$cart->car;
                    $booking->price =$cart->price;
                    $booking->location =$cart->location;
                    $booking->location_name =$cart->location_name;
                    $booking->status = 'success';
                    $booking->car_plate =$cart->car_plate;
                    $booking->car_brand = $cart->car_brand;
                    $booking->carpark_add = $cart->carpark_add;
                    $booking->mobile_number = $cart->mobile_number;
                }
                $booking->save();
                foreach($carts as $cart){
                    Cart::destroy($cart->id);
                }
                $loyaltyadd = $ownData->loyalty_points + round(5 * $request->price);
                User::where('id', $ownData->id)->update(['loyalty_points' =>  $loyaltyadd]);
                \DB::commit();

                return $this->sendSuccess('', 'All Location');
            }else{
                $users = User::where('token', $ownData->login_token)->get();
                foreach($users as $user){
                    $referralUserID = $user->id;
                    $referralUserEmail = $user->email;
                }
                $carts = Cart::where('user_id', $request->user_id)->get();
                \DB::beginTransaction();
                $order = new Order();
                $order->fill($request->all());
                $order->save();
                $orderID  =$order->id;
                $booking = new Booking();
                foreach($carts as $cart){
                    $booking->user_id = $request->user_id;
                    $booking->order_id = $orderID;
                    $booking->date =$cart->date;
                    $booking->car =$cart->car;
                    $booking->price =$cart->price;
                    $booking->location =$cart->location;
                    $booking->location_name =$cart->location_name;
                    $booking->status = 'success';
                    $booking->car_plate =$cart->car_plate;
                    $booking->car_brand = $cart->car_brand;
                    $booking->carpark_add = $cart->carpark_add;
                    $booking->mobile_number = $cart->mobile_number;
                }
                $booking->save();

                foreach($carts as $cart){
                    Cart::destroy($cart->id);
                }
                $coupon1 = strtoupper(substr(uniqid(), 4, 6));
                $details1 = array(
                    'coupon'             => $coupon1
                );
                $coupon2 = strtoupper(substr(uniqid(), 0, 6));
                $details2 = array(
                    'coupon'             => $coupon2
                );
                if($referralUserID){
                    $ReferInert = new ReferralCoupon();
                    $ReferInert->user_id = $referralUserID;
                    $ReferInert->coupon = $coupon1;
                    $ReferInert->save();
                    \Mail::to($referralUserEmail)->send(new \App\Mail\ReferralDiscountSender($details1));
                }
                $ReferInert = new ReferralCoupon();
                $ReferInert->user_id = $ownData->id;
                $ReferInert->coupon = $coupon2;
                $ReferInert->save();
                \Mail::to($ownData->email)->send(new \App\Mail\ReferralDiscountReciever($details2));
                $loyaltyadd = $ownData->loyalty_points + round(5 * $request->price);
                 User::where('id', $ownData->id)->update(['login_token' => null, 'loyalty_points' =>  $loyaltyadd]);
                \DB::commit();
                return $this->sendSuccess('', 'All Location');
            }

        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->sendFailed(['logicError' => $e->getMessage() . ' on line ' . $e->getLine()], 400);
        }
    }
    public function loyaltypoint(Request $request){
        $rules = [
            'loyalty' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendFailed(['logicError' => 'Provide valide Loylty Point'], 400);
        }
       if($request->loyalty != 500){
        return $this->sendFailed(['logicError' => 'You can use only 500 Loyalty Points at a time'], 400);
       }
       $setting = Setting::where('id', 1)->first();
       $userRow = User::where('id', $request->user_id)->first();
       if($userRow->loyalty_points < 500){
        return $this->sendFailed(['logicError' => 'Minimum loyalty points required 500. Currently you have '.$userRow->loyalty_points], 400);
       }
       try {

                $totlePrice = 0;
                $cartRow = Cart::where('user_id', $request->user_id)->OrderBy('id', 'DESC')->get();
                if (count($cartRow) > 0) {
                    foreach ($cartRow as $row) {
                        $totlePrice += $row->price;
                    }
                }
                $remainprice = $totlePrice - ($setting->loyalty_point_discount / 100 * $totlePrice);
                if(count($cartRow) >= $setting->auto_discount_1){
                    $afterdiscout = $remainprice - ($setting->auto_discount_percent_1 / 100 * $remainprice);
                    $remianPoint = $userRow->loyalty_points - 500;
                    User::where('id', $request->user_id)->update(['loyalty_points' => $remianPoint]);
                    return $this->sendSuccess(['payprice' =>  number_format((float)$afterdiscout, 2, '.', ''), 'discount' => $setting->loyalty_point_discount], 'Your Loyalty Discount Successfuly Applied');
                }
                elseif(count($cartRow) >= $setting->auto_discount_2){
                    $afterdiscout = $remainprice - ($setting->auto_discount_percent_2 / 100 * $remainprice);
                    $remianPoint = $userRow->loyalty_points - 500;
                    User::where('id', $request->user_id)->update(['loyalty_points' => $remianPoint]);
                    return $this->sendSuccess(['payprice' =>  number_format((float)$afterdiscout, 2, '.', ''), 'discount' => $setting->loyalty_point_discount], 'Your Loyalty Discount Successfuly Applied');
                }
                else{
                    $remianPoint = $userRow->loyalty_points - 500;
                    User::where('id', $request->user_id)->update(['loyalty_points' => $remianPoint]);
                    return $this->sendSuccess(['payprice' =>  number_format((float)$remainprice, 2, '.', ''), 'discount' => $setting->loyalty_point_discount], 'Your Loyalty Discount  Successfuly Applied');
                }



       } catch (\Throwable $e) {
          return $this->sendFailed(['logicError' => $e->getMessage() . ' on line ' . $e->getLine()], 400);
       }

    }
    public function removeloyalti(Request $request)
    {
        try {
            $user = User::where('id', $request['user_id'])->first();
            $addLoyalti = $user->loyalty_points + 500;
            if(User::where('id', $request['user_id'])->update(['loyalty_points' => $addLoyalti])){
                return $this->sendSuccess('', 'All Location');
            }
            else{
                return $this->sendFailed(['logicError' =>'Try Again'], 400);
            }

        } catch (\Throwable $e) {
            return $this->sendFailed(['logicError' => $e->getMessage() . ' on line ' . $e->getLine()], 400);
        }
    }
    public function bookings(Request $request){
        try {
            $booking = Booking::where('user_id', $request->user_id)->OrderBy('id', 'DESC')->get();
            return $this->sendSuccess($booking, 'All Location');
        } catch (\Throwable $e) {
            return $this->sendFailed(['logicError' => $e->getMessage() . ' on line ' . $e->getLine()], 400);
        }
    }
    public function reschedule(Request $request){
        $rules = [
            'user_id' => 'required',
            'booking_id' => 'required',
            'date' => 'required',
            'status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendFailed(['logicError' => 'Provide Vailde Date'], 400);
        }
        $request['date'] = date("m/d/Y", strtotime($request->date));
        if(!empty($request['another_date'])){
            $request['another_date'] = date("m/d/Y", strtotime($request->another_date));
        }

        try {
            $Reschedule = new Reschedule();
            $Reschedule->fill($request->all());
            $Reschedule->save();
            $RescheduleID = $Reschedule->id;
            if($RescheduleID){
                Booking::where('id', $request->booking_id)->update(['status'=>'reschedule']);
                return $this->sendSuccess('', 'Your Reschedule request seccussfully sended');
            }
            else{
                return $this->sendFailed(['logicError' => 'Provide Vailde Date'], 400);
            }
        } catch (\Throwable $e) {
            return $this->sendFailed(['logicError' => 'Provide Vailde Date'], 400);
        }
    }
    public function cancelrequest(Request $request){
        try {
                Booking::where('id', $request->booking_id)->update(['cancelrequest'=>'pending']);
                return $this->sendSuccess('', 'Your cancel request seccussfully sended');
        } catch (\Throwable $e) {
            return $this->sendFailed(['logicError' => 'Please connect with Admin'], 400);
        }
    }
}
