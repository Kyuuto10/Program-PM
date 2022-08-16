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
        $priorittas = Prioritas::all();
        return view('priority.index',compact('priorittas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('priority.create');
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
            'jenis_prioritas' => 'required'
        ]);

        Prioritas::create($request->all());

        return redirect()->route('priority.index')
                        ->with('msg','Berhasil Menyimpan');
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
    public function edit(Prioritas $prioritas)
    {
        return view('priority.edit',compact('prioritas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prioritas $prioritas)
    {
        $request->validate([
            'jenis_prioritas' => 'required'
        ]);

        $prioritas->update($request->all());

        return redirect()->route('priority.index')
                        ->with('edit','Berhasil Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prioritas $prioritas)
    {
        $prioritas->delete();

        return redirect()->route('priority  .index')
                        ->with('delete','Berhasil Menghapus');
    }
}
