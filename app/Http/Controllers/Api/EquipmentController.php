<?php

namespace App\Http\Controllers\Api;

use App\Equipment;
use App\Http\Controllers\Controller;
use App\Lab;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $labs = Lab::with('Equipment')->get();
        // return response()->json($labs);
        $equipments = Equipment::all();
        return response()->json($equipments);
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
            'equip_id' => 'required',
            'equip_name' => 'required',
            'equip_qty' => 'required',
            'lab_id' => 'required',
        ]);
        $equipment = Equipment::create([
            'equip_id' => $request->equip_id,
            'equip_name' => $request->equip_name,
            'equip_qty' => $request->equip_qty,
            'lab_id' => $request->lab_id,
        ]);
        return response(['message'=>'equipment Added', 'equipment'=>$equipment]);
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
    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'equip_id' => 'required',
            'equip_name' => 'required',
            'equip_qty' => 'required',
            'lab_id' => 'required',
        ]);

        $equipment->update([
            'equip_id' => $request->equip_id,
            'equip_name' => $request->equip_name,
            'equip_qty' => $request->equip_qty,
            'lab_id' => $request->lab_id
        ]);

        return response(['message' => 'equipment Update', 'equipment' => $equipment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Equipment::destroy($id);
    }
}
