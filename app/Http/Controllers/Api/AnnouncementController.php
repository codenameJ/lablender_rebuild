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
        $announcements = Announcement::orderBy('updated_at', 'desc')->get();
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
            'picture_path' => '',
            'image' => '',
        ]);

        $file_data = $request->image;
        $file_name = $request->picture_path;

        @list($type, $file_data) = explode(';', $file_data);
        @list(, $file_data) = explode(',', $file_data);
        if ($file_data != "") { // storing image in storage/app/public Folder
            \Storage::disk('public')->put($file_name, base64_decode($file_data));
        }

        $announcement = Announcement::create([
            'announcement_name' => $request->announcement_name,
            'describe' => $request->describe,
            'lab_id' => $request->lab_id,
            'user_id' => $request->user_id,
            'picture_path' => $file_name,
        ]);
        return response(['message' => 'announcement Added', 'announcement' => $announcement]);
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
            'picture_path' => '',
            'image' => '',
        ]);

        $file_data = $request->image;
        $file_name = $request->picture_path;

        @list($type, $file_data) = explode(';', $file_data);
        @list(, $file_data) = explode(',', $file_data);
        if ($file_data != "") { // storing image in storage/app/public Folder
            \Storage::disk('public')->put($file_name, base64_decode($file_data));
        }

        $announcement->update([
            'announcement_name' => $request->announcement_name,
            'describe' => $request->describe,
            'lab_id' => $request->lab_id,
            'user_id' => $request->user_id,
            'picture_path' => $file_name,
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
