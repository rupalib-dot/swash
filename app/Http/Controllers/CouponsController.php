<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupons;
use App\Models\ReferralCoupon;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'All Coupons List';
        $coupons = Coupons::OrderBy('id', 'DESC')->get();
        $data = compact('title', 'coupons');
        return view('admin.coupons', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create Coupon";
        $data = compact('title');
        return view('admin.addcoupon', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
			'name' => 'required|min:6|max:6',
            'discount' 	=> 'required',
            'valide_date' 	    => 'required'
		];
        $this->validate($request, $rules);
        try
		{

            \DB::beginTransaction();
                    $Coupons = new Coupons();
                    $Coupons->fill($request->all());
                    $Coupons->save();
                \DB::commit();
            return redirect()->route('coupons.index')->with('Success','Coupons created successfully');
        }
        catch (\Throwable $e)
    	{
            \DB::rollback();
            return back()->with('Failed',$e->getMessage())->withInput();
    	}
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
        $coupon  = Coupons::findOrfail(base64_decode($id));
        $title      = "Edit Coupons";
        $data      = compact('title','coupon');
        return view('admin.editcoupon', $data);
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
        $rules = [
			'name' => 'required|min:6|max:6',
            'discount' 	=> 'required',
            'valide_date' 	    => 'required'
		];
        $this->validate($request, $rules);
		try
		{
			\DB::beginTransaction();
               Coupons::findOrfail($id)->update($request->all());
			\DB::commit();
            return redirect()->back()->with('Success','Coupon successfully updated');
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
    public function delete($id)
    {
        $id = base64_decode($id);
        Coupons::destroy($id);
        return redirect()->route('coupons.index')->with('Success','Coupon successfully deleted');
    }
    public function referralCoupon(){
        $title = "Referral Coupons";
        $coupons = ReferralCoupon::OrderBy('id', 'DESC')->get();
        $data = compact('title', 'coupons');
        return view('admin.referral', $data);

    }
}
