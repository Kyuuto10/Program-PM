<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stattus = Status::all();
        return view('status.index',compact('stattus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('status.create');
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
            'nama_status' => 'required',
        ]);

        if($request->has('aktif')){
            $aktif = 1;
        }else{
            $aktif = 0;
        }

        Status::create([
            'nama_status' => $request->nama_status,
            'aktif' => $aktif
        ]);

        toast('Berhasil Menambah','success'); 
        return redirect()->route('status.index');
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
    public function edit(Status $status)
    {
        // return view('status.edit',compact('status'));
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $request->validate([
            'nama_status' => 'required'
        ]);

        if($request->has('aktif')){
            $aktif = 1;
        }else{
            $aktif = 0;
        }

        $status->update([
            'nama_status' => $request->nama_status,
            'aktif' => $aktif
        ]);

        toast('Berhasil Edit','success'); 
        return redirect()->route('status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $status->delete();

        toast('Berhasil Menghapus','success');
        return redirect()->route('status.index');
    }
}
