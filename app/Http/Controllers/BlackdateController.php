<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blackout;
use App\Models\Locations;

class BlackdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'All Black Out List';
        $blackouts = Blackout::OrderBy('id', 'DESC')->get();
        $data = compact('title', 'blackouts');
        return view('admin.blackout', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create Black Out List";
        $locations = Locations::OrderBy('id', 'DESC')->get();
        $data = compact('title', 'locations');
        return view('admin.addblackout', $data);
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
			'startdate' => 'required',
            'enddate' 	=> 'required|after:startdate',
            'location' 	    => 'required'
		];
        $this->validate($request, $rules);
        try
		{

            \DB::beginTransaction();
                    $Blackout = new Blackout();
                    $Blackout->fill($request->all());
                    $Blackout->save();
                \DB::commit();
            return redirect()->route('blackout.index')->with('Success','Black out list created successfully');
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
        $blackout        = Blackout::findOrfail(base64_decode($id));
        $locations =   Locations::OrderBy('id', 'DESC')->get();
        $title              = "Edit black out list";
        $data               = compact('title','blackout', 'locations');
        return view('admin.editblackout', $data);
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
			'startdate' => 'required',
            'enddate' 	=> 'required|after:startdate',
            'location' 	    => 'required'
		];
        $this->validate($request, $rules);
		try
		{
			\DB::beginTransaction();
               Blackout::findOrfail($id)->update($request->all());
			\DB::commit();
            return redirect()->back()->with('Success','Black out list successfully updated');
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
        Blackout::destroy($id);
        return redirect()->route('blackout.index')->with('Success','Black out list successfully deleted');
    }
}
