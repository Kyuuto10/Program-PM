<?php

namespace App\Http\Controllers;

use App\Models\Prioritas;
use Illuminate\Http\Request;

class PrioritasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priorities = Prioritas::all();
        return view('priority.index',compact('priorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('priority.create');
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
            'nama_prioritas' => 'required'
        ]);

        if($request->has('aktif')){
            $aktif = 1;
        }else{
            $aktif = 0;
        }

        Prioritas::create([        
            'nama_prioritas' => $request->nama_prioritas,
            'aktif' => $aktif
        ]);

        toast('Berhasil Menambah','success');
        return redirect()->route('priority.index');
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
    public function edit()
    {
        // return view('priority.edit',compact('prioritas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prioritas $priority)
    {
        $request->validate([
            'nama_prioritas' => 'required'
        ]);

        if($request->has('aktif')){
            $aktif = 1;
        }else{
            $aktif =0;
        }

        $priority->update([
            'nama_prioritas' => $request->nama_prioritas,
            'aktif' => $aktif
        ]);

        toast('Berhasil Edit','success');
        return redirect()->route('priority.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prioritas $priority)
    {
        $priority->delete();
        
        toast('Berhasil Menghapus','success');
        return redirect()->route('priority.index');
    }
}
