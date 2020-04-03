<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Request_detail;
use App\Request_list;
use Illuminate\Http\Request;

class MissingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $missing_lists = Request_list::with(['Request_detail' => function ($query) {
            $query->where('status', 'missing');
        }])->get();

        return response()->json($missing_lists);
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
        $missing_list = Request_list::find($id);
        $missing_list->status = $request->get('status');
        $missing_list->update();

        if($request->cmd == 'return'){
            $data = $request->json()->all();
            foreach ($data['selectedDetails'] as $detail) {
                $request_detail = Request_detail::find($detail['id']);
                $request_detail->status = $detail['status'];
                $request_detail->update();
            }
        }
        
        return response(['message' => 'request list Update', 'request list' => $missing_list]);
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
