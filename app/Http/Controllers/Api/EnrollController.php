<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lab;
use App\Student;
use Illuminate\Http\Request;

class EnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labs = Lab::with('Student')->get();
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
        //
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
    public function update(Request $request, $id)
    {
        if ($request->cmd == 'cancel') {
            $lab = Lab::where('id', '=', $request->lab_id)->first();
            $student = Student::where('id', '=', $request->student_id)->first();

            $student->Labs()->detach($lab);

            return response(['message' => 'Enroll removed', 'enroll' => $student]);
        } else {
            $lab = Lab::where('id', '=', $request->lab_id)->first();
            $student = Student::where('id', '=', $request->student_id)->first();

            $student->Labs()->updateExistingPivot($lab, ['status' => 'joined']);

            return response(['message' => 'Joined Success', 'enroll' => $student]);
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
        //
    }
}
