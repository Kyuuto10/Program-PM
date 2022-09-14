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
        $projects = DB::table('data')
                    ->join('teknisi','data.id_teknisi','=','teknisi.id')
                    ->join('produk','data.id_produk','=','produk.id')
                    ->select('data.*','teknisi.nama_teknisi','produk.nama_produk')
                    ->get();

        $search = $request->query('search');

        if(!empty($search)) {
            $data = Data::latest()->sortable()
            ->where('project.nama_instansi','like','%'. $search . '%')
            ->orWhere('project.id_teknisi','like','%'. $search . '%')
            ->paginate(10)->onEachSide(2)->fragment('data');
        }else{
            $projects = Data::latest()->sortable()->paginate(10)->onEachSide(2)->fragment('data');
        }


        $product = Produk::all();
        $priorities = Prioritas::all();
        $jobdesks = Jobdesk::all();
        $stattus = Status::all();
        // $projects = Project::sortable()->paginate(5)->onEachSide(2)->fragment('data');
        $teknisis = Teknisi::all();

        return view('project.index',compact('product','priorities','jobdesks','stattus','teknisis','projects'))
            ->with([
                'data' => $projects,
                'search' => $search,             
            ]);
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
            // 'foto.*' => 'required|image|mimes:jpeg,jpg,png,svg,gif|max:2048',
            // 'foto.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048',
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
                'id_user' => (auth()->user()->name),
                'date_modified' => Carbon::today() 
            ]); 
      
    //     DB::transaction(function () use ($data) {
    //         // looping foto
    //         foreach ($request->file('foto') as $file) {
    //             $name = $file->getClientOriginalName();
    //             $file->move(public_path('images'). "/images/$name");
    //             $data['foto'] = $name;
            
    //         // simpan
    //         $foto = new Project();
    //         $foto->foto = json_encode($data);
    //         }
            

    //     $data->save();
            
    // });
        
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
        // $project = Project::find(1);
        // $fotos = $project->foto;
        // foreach($fotos as $foto){
            
        // }
        // return view('project.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Data $project)
    {
        $product = Produk::all();
        $priorittas = Prioritas::all();
        $jobdesks = Jobdesk::all();
        $stattus = Status::all();
        $projects = Data::all();
        $teknisis = Teknisi::all();
        // return view('project.edit',compact('project','product','priorittas','jobdesks','stattus','projects','teknisis'));
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
            'status1' => $request->status_pengiriman,
            'tgl_kembali' => $request->tgl_kembali,
            'status_kembali' => $request->status_kembali,
            'comment' => $request->comment,
            'id_user' => (auth()->user()->name),
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