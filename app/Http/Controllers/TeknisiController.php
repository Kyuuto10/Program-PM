<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use Illuminate\Http\Request;

class TeknisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teknisis = Teknisi::all();
        return view('teknisi.index',compact('teknisis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('teknisi.create');
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
            'id' => 'required|numeric',
            'nama_teknisi' => 'required',
        ]);

        if($request->has('aktif')){
            $aktif = 1;
        }else{
            $aktif = 0;
        }

        Teknisi::create([
            'id' => $request->id,
            'nama_teknisi' => $request->nama_teknisi,
            'aktif' => $aktif,
        ]);

        toast('Berhasil Menambah','success');
        return redirect()->route('teknisi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Teknisi $teknisi)
    {
        return view('teknisi.show',compact('teknisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Teknisi $teknisi)
    {
        // return view('teknisi.edit',compact('teknisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teknisi $teknisi)
    {
        $request->validate([
            'id' => 'required|numeric',
            'nama_teknisi' => 'required',
        ]);

        if($request->has('aktif')){
            $aktif = 1;
        }else{
            $aktif = 0;
        }

        $teknisi->update([
            'id' => $request->id,
            'nama_teknisi' => $request->nama_teknisi,
            'aktif' => $aktif,
        ]);

        toast('Berhasil Edit','success');
        return redirect()->route('teknisi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teknisi $teknisi)
    {
        $teknisi->delete();

        toast('Berhasil Menghapus','success');
        return redirect()->route('teknisi.index');
    }
}
