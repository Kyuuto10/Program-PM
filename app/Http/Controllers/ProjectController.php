<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Prioritas;
use App\Models\Jobdesk;
use App\Models\Status;
use App\Models\Project;
use App\Models\Teknisi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Produk::all();
        $priorittas = Prioritas::all();
        $jobdesks = Jobdesk::all();
        $stattus = Status::all();
        $projects = Project::latest()->paginate(10);
        $teknisis = Teknisi::all();

        if(request('search')){
            $projects->where('nama_instansi','like','%'. request('search'). '%');
        }
        return view('project.index',compact('projects'))
            ->with('i',(request()->input('page', 1) - 1 ) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Produk::all();
        $priorittas = Prioritas::all();
        $jobdesks = Jobdesk::all();
        $stattus = Status::all();
        $projects = Project::all();
        $teknisis = Teknisi::all();
        return view('project.create',compact('product','priorittas','jobdesks','stattus','projects','teknisis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return  $request->file('foto')->store('images');
// ddd($request);
        $request->validate([
            'nama_instansi' => 'required',
            'nama_lokasi' => 'required',
            'nama_teknisi' => 'required',
            'produk' => 'required',
            'warranty' => 'required',
            'priority' => 'required',
            'jobdesk' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'foto' => 'image|file|max:2048',
            'item' => 'required',
            'tgl_pengiriman' => 'required',
            'status1' => 'required',
            'tgl_kembali' => 'required',
            'status2' => 'required'
        ]); 
        
        $data = Project::create([
            'tanggal' => Carbon::today(),
            'nama_instansi' => $request->nama_instansi,
            'nama_lokasi' => $request->nama_lokasi,
            'nama_teknisi' => $request->nama_teknisi,
            'produk' => $request->produk,
            'warranty' => $request->warranty,
            'priority' => $request->priority,
            'jobdesk' => $request->jobdesk,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'foto' => $request->foto,
            'item' => $request->item,
            'tgl_pengiriman' => $request->tgl_pengiriman,
            'status1' => $request->status1,
            'tgl_kembali' => $request->tgl_kembali,
            'status2' => $request->status2
            ]);
        if($request->file('foto')){
            $file = $request->file('foto');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['foto'] = $filename;
        } 

        // if($foto = $request->file('foto')){
        //     $destinationPath = 'foto/';
        //     $profileImage = date('YmdHis'). "." . $foto->getClientOriginalExtension();
        //     $foto->move($destinationPath, $profileImage);
        //     $data['foto'] = "$profileImage";
        // }
        $data->save();

    //    Project::create([
    //         // 'tanggal' => $request->tanggal,
    //         'nama_instansi' => $request->nama_instansi,
    //         'nama_lokasi' => $request->nama_lokasi,
    //         'nama_teknisi' => $request->nama_teknisi,
    //         'produk' => $request->produk,
    //         'warranty' => $request->warranty,
    //         'priority' => $request->priority,
    //         'jobdesk' => $request->jobdesk,
    //         'deskripsi' => $request->deskripsi,
    //         'status' => $request->status,
    //         'foto' => $request->foto,
    //         'item' => $request->item,
    //         'tgl_pengiriman' => $request->tgl_pengiriman,
    //         'status1' => $request->status1,
    //         'tgl_kembali' => $request->tgl_kembali,
    //         'status2' => $request->status2
    //     ]);

        return redirect()->route('project.index')
                        ->with('msg','Berhasil Menyimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('project.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $product = Produk::all();
        $priorittas = Prioritas::all();
        $jobdesks = Jobdesk::all();
        $stattus = Status::all();
        $projects = Project::all();
        $teknisis = Teknisi::all();
        return view('project.edit',compact('project','product','priorittas','jobdesks','stattus','projects','teknisis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // ddd($request);
        $request->validate([
            'nama_instansi' => 'required',
            'nama_lokasi' => 'required',
            'nama_teknisi' => 'required',
            'produk' => 'required',
            'warranty' => 'required',
            'priority' => 'required',
            'jobdesk' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'foto' => 'image|file|max:2048',
            'item' => 'required',
            'tgl_pengiriman' => 'required',
            'status1' => 'required',
            'tgl_kembali' => 'required',
            'status2' => 'required'
        ]);

        if($request->file('foto')){
            $request->foto['foto'] = $request->file('foto')->update('images'); 
        }

       $project->update([
            'tanggal' => Carbon::today(),
            'nama_instansi' => $request->nama_instansi,
            'nama_lokasi' => $request->nama_lokasi,
            'nama_teknisi' => $request->nama_teknisi,
            'produk' => $request->produk,
            'warranty' => $request->warranty,
            'priority' => $request->priority,
            'jobdesk' => $request->jobdesk,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'foto' => $request->foto,
            'item' => $request->item,
            'tgl_pengiriman' => $request->tgl_pengiriman,
            'status1' => $request->status1,
            'tgl_kembali' => $request->tgl_kembali,
            'status2' => $request->status2
        ]);

        return redirect()->route('project.index')
                        ->with('edit','Berhasil Edit');
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
