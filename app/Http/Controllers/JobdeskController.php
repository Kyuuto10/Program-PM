<?php

namespace App\Http\Controllers;

use App\Models\Jobdesk;
use Illuminate\Http\Request;

class JobdeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobdesks = Jobdesk::all();
        return view('jobdesk.index',compact('jobdesks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('jobdesk.create');
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
            'nama_jobdesk' => 'required'
        ]);

        if($request->has('aktif')){
            $aktif = 1;
        }else{
            $aktif = 0;
        }

        Jobdesk::create([
            'nama_jobdesk' => $request->nama_jobdesk,
            'aktif' => $aktif
        ]);

        toast('Berhasil Menambah','success');
        return redirect()->route('jobdesk.index');
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
    public function edit(Jobdesk $jobdesk)
    {
        // return view('jobdesk.edit',compact('jobdesk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jobdesk $jobdesk)
    {
        $request->validate([
            'nama_jobdesk' => 'required'
        ]);

        if($request->has('aktif')){
            $aktif = 1;
        }else{
            $aktif = 0;
        }

        $jobdesk->update([
            'nama_jobdesk' => $request->nama_jobdesk,
            'aktif' => $aktif
        ]);

        toast('Berhasil Edit','success');
        return redirect()->route('jobdesk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jobdesk $jobdesk)
    {
        $jobdesk->delete();

        toast('Berhasil Menghapus','success');
        return redirect()->route('jobdesk.index');
    }
}
