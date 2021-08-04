<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Setting as GlobalSetting;

class SettingController extends Controller
{
    public function settingPage(){
        $title = 'Application Aettings';
        $settings = Setting::where('id', 1)->first();
        $data = compact('title', 'settings');
        return view('admin.setting', $data);
    }
    public function updateSetting(Request $request){
        $rule = [
            'currency' => 'required',
            'payment_key_1' => 'required',
            'payment_key_2' => 'required',
            'car_price_1' => 'required',
            'car_price_2' => 'required',
            'car_price_3' => 'required',
            'car_trial_price_1' => 'required',
            'car_trial_price_2' => 'required',
            'car_trial_price_3' => 'required',
            'auto_discount_1' => 'required',
            'auto_discount_percent_1' => 'required',
            'auto_discount_2' => 'required',
            'auto_discount_percent_2' => 'required',
            'loyalty_point_discount' => 'required'
        ];
      $this->validate($request,$rule);
      try
		{
			\DB::beginTransaction();
               Setting::findOrfail(1)->update($request->all());
			\DB::commit();
            return redirect()->back()->with('Success','Application Setting successfully updated');
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
            return back()->with('Failed',$e->getMessage())->withInput();
    	}
    }
}
