<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;

class ClientController extends Controller
{
    public function index()
    {
        $clients    = User::where('role', 'client')->OrderBy('id','DESC')->get();
        $title          = "All Clients";
        $data           = compact('title','clients');
        return view('admin.clients', $data);
    }
    public function edit($id)
    {
        $client        = User::findOrfail(base64_decode($id));
        $title              = "Edit Client";
        $data               = compact('title','client');
        return view('admin.addclient', $data);
    }
    public function update(Request $request, $id)
    {
       $id = base64_decode($id);
		$rules = [
			'name' 	    => 'required|min:3|max:30',
			'phone' 	=> 'required|digits:10|unique:users,phone,'.$id.',id',
			'email' 	=> 'required|max:50|unique:users,email,'.$id.',id|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
            'image' 	    => 'mimes:jpeg,jpg,png|max:2048',
		];
        $this->validate($request, $rules);
        if(!empty($request->file('image')))
            {
                $imageName = time().'_'.rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
                $request->file('image')->storeAs('image', $imageName, 'public');
                $request['photo'] = $imageName;
            }
		try
		{
			\DB::beginTransaction();
				User::findOrfail($id)->update($request->all());
			\DB::commit();
            return redirect()->back()->with('Success','Client Data successfully updated');
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
            return back()->with('Failed',$e->getMessage())->withInput();
    	}
    }
    public function updateStatus($id){
        $id = base64_decode($id);
        $row = User::where('id', $id)->first();
        $status = $row->status;
        try{
            if($status === 'active'){
                \DB::beginTransaction();
                $updates = User::where('id', $id)->update(['status' => 'deactive']);
                \DB::commit();
                return back()->with('Success', 'The Client status Successfully update');
            }
            else{
                \DB::beginTransaction();
                $updates = User::where('id', $id)->update(['status' => 'active']);
                \DB::commit();
                return back()->with('Success', 'The Client status Successfully update');
            }
        } catch (\Throwable $e) {
            \DB::rollback();
            return back()->with('Failed', $e->getMessage())->withInput();
        }

    }
}
