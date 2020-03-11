<?php

namespace App\Http\Controllers\Api;

use App\Announcement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::all();
        return response()->json($announcements);
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
            'announcement_name' => 'required',
            'describe' => 'required',
            'lab_id' => 'required',
            'user_id' => 'required',
        ]);
        $announcement = Announcement::create([
            'announcement_name' => $request->announcement_name,
            'describe' => $request->describe,
            'lab_id' => $request->lab_id,
            'user_id' => $request->user_id,
        ]);
        return response(['message'=>'announcement Added', 'announcement'=>$announcement]);
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
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'announcement_name' => 'required',
            'describe' => 'required',
            'lab_id' => 'required',
            'user_id' => 'required',
        ]);

        $announcement->update([
            'announcement_name' => $request->announcement_name,
            'describe' => $request->describe,
            'lab_id' => $request->lab_id,
            'user_id' => $request->user_id,
        ]);

        return response(['message' => 'Announcement Update', 'Announcement' => $announcement]);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Announcement::destroy($id);
    }
}
