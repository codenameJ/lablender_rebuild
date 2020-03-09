<?php

namespace App\Http\Controllers\Api;

use App\Assign;
use App\Http\Controllers\Controller;
use App\Lab;
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

        $users = User::with('Student')->with('Ta')->get();
        // $users = User::all();
        return response()->json($users);

        // $users = User::all();
        // return response()->json($users);

        // $tas = Ta::all();
        // return response()->json($tas);

        // $students = Student::all();
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
            'lab_id' => '',
            'student_id' => '',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'type' => $request->type,
        ]);

        //  return response(['message'=>'User Added', 'user'=>$user]);

        if ($request->type === 'ta') {
            $ta = Ta::create([
                'user_id' => $user->id,
            ]);

            $lab = Lab::where('course_id', '=', $request->lab_id)->first();

            $assign =Assign::create([
                'ta_id' => $ta->id,
                'lab_id' => $lab->id,
            ]);

            return response(['message' => 'ta Added', 'ta' => $ta]);
        }

        if ($request->type === 'student') {
            $student = Student::create([
                'student_id' => $request->student_id,
                'user_id' => $user->id,
            ]);

            return response(['message' => 'student Added', 'student' => $student]);
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
            'student_id' => '',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone'=>$request->phone,
            'type' => $request->type,
        ]);

        //  return response(['message'=>'User Updated', 'user'=>$user]);


        // if ($request->Type === 'ta') {
        //     $editta = Ta::where('user_id', '=', $user->id);
        //     $editta->update([
        //         'TA_Name' => $request->Name,
        //         'Lab_id' => $request->Lab,
        //     ]);

        //     return response(['message' => 'ta Update', 'ta' => $editta]);
        // }

        if ($request->type === 'student') {
            $editstd = Student::where('user_id', '=', $user->id);
            $editstd->update([
                'Student_id' => $request->student_id,
            ]);

            return response(['message' => 'student Update', 'student' => $editstd]);
        }
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
