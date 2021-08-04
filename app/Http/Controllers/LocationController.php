<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locations;
class LocationController extends Controller
{

    public function index()
    {
        $locations    = Locations::OrderBy('id','DESC')->get();
        $title          = "All Locations";
        $data           = compact('title','locations');
        return view('admin.locations', $data);
    }

    public function create()
    {
        $title              = "Add Location";
        $data               = compact('title');
        return view('admin.addlocation', $data);
    }

    public function store(Request $request)
    {
        $rules = [
			'name' 	    => 'required|min:3|max:30',
            'address' 	    => 'required|min:5|max:150',
            'postcode' 	    => 'required|numeric',
            'capacity' 	    => 'required|numeric'
		];
        $this->validate($request, $rules);
        try
		{
            \DB::beginTransaction();
                    $Locations = new Locations();
                    $Locations->fill($request->all());
                    $Locations->save();
                \DB::commit();
            return redirect()->route('locations.index')->with('Success','Location created successfully');
        }
        catch (\Throwable $e)
    	{
            \DB::rollback();
            return back()->with('Failed',$e->getMessage())->withInput();
    	}
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $location    = Locations::findOrfail($id);
        $title          = "Edit Location";
        $data           = compact('title','location');
        return view('admin.editlocation', $data);
    }

    public function update(Request $request, $id)
    {

        $rules = [
			'name' 	    => 'required|min:3|max:30',
            'address' 	    => 'required|min:5|max:150',
            'postcode' 	    => 'required|min:5|max:10',
            'capacity' 	    => 'required|min:1|max:2'
		];
        $this->validate($request, $rules);
        try
		{

                \DB::beginTransaction();
                    Locations::findOrFail($id)->update($request->all());
                \DB::commit();
                return redirect()->back()->with('Success','Location updated successfully');

        }
        catch (\Throwable $e)
    	{
            \DB::rollback();
            return back()->with('Failed',$e->getMessage())->withInput();
    	}
    }

    public function delete($id)
    {
        $id = base64_decode($id);
         Locations::destroy($id);
         return redirect()->route('locations.index')->with('Success','Location delete successfully');
    }
}
