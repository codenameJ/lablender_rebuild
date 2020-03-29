<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lab;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $labs = Lab::all();
        $labs = Lab::with('Student')->with('Ta')->get();
        return response()->json($labs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'course_name' => 'required',
            'professor_name' => 'required',
        ]);
        $lab = Lab::create([
            'course_id' => $request->course_id,
            'course_name' => $request->course_name,
            'professor_name' => $request->professor_name,
        ]);
        return response(['message'=>'lab Added', 'lab'=>$lab]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lab $lab)
    {
        $request->validate([
            'course_id' => 'required',
            'course_name' => 'required',
            'professor_name' => 'required',
        ]);

        $lab->update([
            'course_id' => $request->course_id,
            'course_name' => $request->course_name,
            'professor_name' => $request->professor_name,
        ]);

        return response(['message' => 'lab Update', 'lab' => $lab]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Lab::destroy($id);
    }
}
