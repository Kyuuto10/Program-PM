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
        return view('teknisi.create');
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
            'code' => 'required|numeric',
            'nama_teknisi' => 'required'
        ]);

        Teknisi::create($request->all());
        return redirect()->route('teknisi.index')
                        ->with('msg','Berhasil menambah');
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
        return view('teknisi.edit',compact('teknisi'));
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
            'code' => 'required|numeric',
            'nama_teknisi' => 'required'
        ]);

        $teknisi->update($request->all());
        return redirect()->route('teknisi.index')
                        ->with('edit','Berhasil edit');
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

        return redirect()->route('teknisi.index')
                        ->with('delete','Berhasil hapus');
    }
}
