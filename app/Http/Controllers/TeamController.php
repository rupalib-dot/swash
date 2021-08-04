<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locations;
use App\Models\Teams;
class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'All Teams';
        $teams = Teams::OrderBy('id', 'DESC')->get();
        $data = compact('title', 'teams');
        return view('admin.teams', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create New Team Member";
        $locations = Locations::OrderBy('id', 'DESC')->get();
        $data = compact('title', 'locations');
        return view('admin.addteam', $data);
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
			'name' 	    => 'required|min:3|max:30',
            'phone' 	=> 'required|digits:10|unique:teams,phone',
			'email' 	=> 'required|max:50|unique:teams,email|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
            'image' 	    => 'mimes:jpeg,jpg,png|max:2048',
            'location' 	    => 'required'
		];
        $this->validate($request, $rules);
        try
		{
            if(!empty($request->file('image')))
            {
                $imageName = time().'_'.rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
                $request->file('image')->storeAs('image', $imageName, 'public');
                $request['photo'] = $imageName;
            }
            \DB::beginTransaction();
                    $Teams = new Teams();
                    $Teams->fill($request->all());
                    $Teams->save();
                \DB::commit();
            return redirect()->route('teams.index')->with('Success','Team Member created successfully');
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
        $team        = Teams::findOrfail(base64_decode($id));
        $locations = Locations::OrderBy('id', 'DESC')->get();
        $title              = "Edit Team Member";
        $data               = compact('title','team', 'locations');
        return view('admin.editteam', $data);
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
			'name' 	    => 'required|min:3|max:30',
            'phone' 	=> 'required|digits:10|unique:teams,phone,'.$id.',id',
			'email' 	=> 'required|max:50|unique:teams,email,'.$id.',id|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
            'image' 	    => 'mimes:jpeg,jpg,png|max:2048',
        ];
        $this->validate($request, $rules);
         $teamRow = Teams::where('id',$id)->first();
         $request['photo'] = $teamRow->photo;
        if(!empty($request->file('image')))
            {
                $imageName = time().'_'.rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
                $request->file('image')->storeAs('image', $imageName, 'public');
                $request['photo'] = $imageName;
            }
		try
		{
			\DB::beginTransaction();
               Teams::findOrfail($id)->update($request->all());
			\DB::commit();
            return redirect()->back()->with('Success','Team Member Data successfully updated');
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
        Teams::destroy($id);
        return redirect()->route('teams.index')->with('Success','Team Member successfully deleted');
    }
}
