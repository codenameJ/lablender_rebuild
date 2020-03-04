<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Student;
use App\Ta;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $users = User::with('Ta')->with('Student')->get();
        $users = User::all();
        return response()->json($users);

        // $users = User::all();
        // return response()->json($users);

        // $tas = Ta::all();
        // return response()->json($tas);

        // $students = Ta::all();
        // return response()->json($students);
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'type' => '',
            'Lab' => '',
            'Stdid' => '',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'type' => $request->type,
        ]);

         return response(['message'=>'User Added', 'user'=>$user]);

        // if ($request->Type === 'ta') {
        //     $ta = Ta::create([
        //         'TA_Name' => $user->Name,
        //         'client_id' => $user->User_id,
        //         'Lab_id' => $request->Lab,
        //     ]);

        //     return response(['message' => 'ta Added', 'ta' => $ta]);
        // }

        // if ($request->Type === 'student') {
        //     $student = Student::create([
        //         'Student_id' => $request->Stdid,
        //         'Student_Name' => $user->Name,
        //         'client_id' => $user->User_id,
        //     ]);

        //     return response(['message' => 'student Added', 'student' => $student]);
        // }
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
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'type' => 'required',
            'Lab' => '',
            'Stdid' => '',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone'=>$request->phone,
            'type' => $request->type,
        ]);

        //  return response(['message'=>'User Updated', 'user'=>$user]);


        // if ($request->Type === 'ta') {
        //     $editta = Ta::where('client_id', '=', $user->User_id);
        //     $editta->update([
        //         'TA_Name' => $request->Name,
        //         'Lab_id' => $request->Lab,
        //     ]);

        //     return response(['message' => 'ta Update', 'ta' => $editta]);
        // }

        // if ($request->Type === 'student') {
        //     $editstd = Student::where('client_id', '=', $user->User_id);
        //     $editstd->update([
        //         'Student_id' => $request->Stdid,
        //         'Student_Name' => $request->Name,
        //         'client_id' => $user->User_id,
        //     ]);

        //     return response(['message' => 'student Update', 'student' => $editstd]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::destroy($id);
    }
}
