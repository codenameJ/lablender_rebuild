<?php

namespace App\Http\Controllers\Api;

use App\Equipment;
use App\Http\Controllers\Controller;
use App\Request_detail;
use App\Request_list;
use Illuminate\Http\Request;

class RequestlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $request_lists = Request_list::all();
        $request_lists = Request_list::with('Request_detail')->get();

        // $request_lists = Request_list::with(['Request_detail' => function ($query) {
        //     $query->where('status', 'missing');
        // }])->get();

        return response()->json($request_lists);
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
            'student_id' => 'required',
            'lab_id' => 'required',
        ]);
        $request_list = Request_list::create([
            'student_id' => $request->student_id,
            'lab_id' => $request->lab_id,
        ]);

        $data = $request->json()->all();

        if ($request_list->id) {

            foreach ($data['cart'] as $getcart) {
                $request_detail = new Request_detail();
                $request_detail->request_list_id = $request_list->id;
                $request_detail->equipment_id = $getcart['id'];
                $request_detail->len_qty = $getcart['amount'];
                $request_detail->save();

                $equipment = Equipment::where('id', '=', $getcart['id'])->first();
                $oldqty = $equipment->equip_qty;
                $newqty = $oldqty - $getcart['amount'];
                $equipment->update([
                    'equip_qty' => $newqty,
                ]);
            }
            return response(['message' => 'requestlist Added', 'request' => $request_list]);
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
    public function update(Request $request, $id)
    {
        $request_list = Request_list::find($id);
        $request_list->status = $request->get('status');
        $request_list->update();

        if($request->cmd == 'return'){
            $data = $request->json()->all();
            foreach ($data['selectedDetails'] as $detail) {
                $request_detail = Request_detail::find($detail['id']);
                $request_detail->status = $detail['status'];
                $request_detail->update();
            }
        }
        
        return response(['message' => 'request list Update', 'request list' => $request_list]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Request_list::destroy($id);
    }
}
