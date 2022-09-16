<?php

namespace App\Http\Controllers;

use App\Models\{ Produk,Prioritas,Jobdesk,Status,Teknisi };
use App\Models\Data;
use App\Exports\DataExport;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Data::join('teknisi','data.id_teknisi','=','teknisi.id')
                    ->join('status','data.id_status','=','status.id')
                    ->join('produk','data.id_produk','=','produk.id')
                    ->join('prioritas','data.id_prioritas','=','prioritas.id')
                    ->join('jobdesk','data.id_jobdesk','=','jobdesk.id')
                    ->join('users','data.id_user','=','users.id')
                    ->select('data.*',
                            'teknisi.nama_teknisi',
                            'produk.nama_produk',
                            'prioritas.nama_prioritas',
                            'jobdesk.nama_jobdesk',
                            'status.nama_status',
                            'users.name')
                    ->get();

        $product = Produk::all();
        $priorities = Prioritas::all();
        $jobdesks = Jobdesk::all();
        $stattus = Status::all();        
        $teknisis = Teknisi::all();

        return view('project.index',compact('product','priorities','jobdesks','stattus','teknisis','projects'))
            ->with(['data' => $projects]);
    }

    public function export()
    {
        return Excel::download(new DataExport, 'Data.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

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
            'nama_instansi' => 'required',
            'nama_lokasi' => 'required',
            'id_teknisi' => 'required',
            'id_produk' => 'required',
            'warranty' => 'required',
            'id_prioritas' => 'required',
            'id_jobdesk' => 'required',
            'deskripsi' => 'required',
            'id_status' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'item' => 'required',
            
        ]); 

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/'),"/$imageName");

        Data::create([
                'tanggal' => Carbon::today(),
                'nama_instansi' => $request->nama_instansi,
                'nama_lokasi' => $request->nama_lokasi,
                'id_teknisi' => $request->id_teknisi,
                'id_produk' => $request->id_produk,
                'warranty' => $request->warranty,
                'id_prioritas' => $request->id_prioritas,
                'id_jobdesk' => $request->id_jobdesk,
                'deskripsi' => $request->deskripsi,
                'id_status' => $request->id_status,            
                'image' => $request->image->getClientOriginalName(),
                'item' => $request->item,
                'tgl_pengiriman' => $request->tgl_pengiriman,
                'status_pengiriman' => $request->status_pengiriman,
                'tgl_kembali' => $request->tgl_kembali,
                'status_kembali' => $request->status_kembali,
                'comment' => $request->comment,
                'id_user' => (auth()->user()->id),
                'date_modified' => Carbon::today() 
            ]); 
        
        toast('Berhasil Menambah','success');
        return redirect()->route('project.index');             
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Data $project)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Data $project)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Data $project)
    {
        // ddd($request);
        $request->validate([            
            'id_teknisi' => 'required',
            'id_produk' => 'required',            
            'id_prioritas' => 'required',
            'id_jobdesk' => 'required',            
            'id_status' => 'required',                    
        ]); 

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/'),"/$imageName");

       $project->update([            
            'nama_instansi' => $request->nama_instansi,
            'nama_lokasi' => $request->nama_lokasi,
            'id_teknisi' => $request->id_teknisi,
            'id_produk' => $request->id_produk,
            'warranty' => $request->warranty,
            'id_prioritas' => $request->id_prioritas,
            'id_jobdesk' => $request->id_jobdesk,
            'deskripsi' => $request->deskripsi,
            'id_status' => $request->id_status,
            'image' => $request->image->getClientOriginalName(),
            'item' => $request->item,
            'tgl_pengiriman' => $request->tgl_pengiriman,
            'status_pengiriman' => $request->status_pengiriman,
            'tgl_kembali' => $request->tgl_kembali,
            'status_kembali' => $request->status_kembali,
            'comment' => $request->comment,
            'id_user' => (auth()->user()->id),
            'date_modified' => Carbon::today()
        ]);

        toast('Berhasil Edit','success');
        return redirect()->route('project.index');
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