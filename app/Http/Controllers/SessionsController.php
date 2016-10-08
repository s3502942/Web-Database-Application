<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Session;

class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        /*generating id  ? */
        $sessions = Session::orderBy('id', 'DESC')->paginate(5);

        return view('admin.sessions', compact('sessions'))->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "start_time" => 'required',
            "duration" => 'required',
            "num_bookings" => 'required',
            "mv_id" => 'required',
            "t_id" => 'required',
        ]);
        Session::create($request->all());

        return redirect()->route('admin_sessions.index')->with('success','Session created successfully');
    }

    public function create()
    {
        return view('admin.sessions');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "start_time" => 'required',
            "duration" => 'required',
            "num_bookings" => 'required',
            "mv_id" => 'required',
            "t_id" => 'required',
        ]);
        Session::find($id)->update($request->all());
        return redirect()->route('admin_sessions.index') ->with('success','Product updated successfully');
    }

    public function destroy($id)
    {
        Session::find($id)->delete();
        return redirect()->route('admin_sessions.index') ->with('success','Theatre deleted successfully');
    }

    public function edit($id)
    {
        $sessions = Session::find($id);
        return view('admin.forms.session_edit',compact('sessions'));
    }
}
