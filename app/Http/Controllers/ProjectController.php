<?php

namespace App\Http\Controllers;

use App\Models\{ Produk,Prioritas,Jobdesk,Status,Teknisi,Foto };
use App\Models\Project;
use App\Exports\DataExport;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use DataTables;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = Produk::all();
        $priorittas = Prioritas::all();
        $jobdesks = Jobdesk::all();
        $stattus = Status::all();
        $projects = Project::latest()->paginate(10);
        $teknisis = Teknisi::all();

        foreach($projects as $project){
        // $show = $this->show('project.show', $project->id);
        if ($request->ajax()) {
            $projects = Project::select('*');
            return Datatables::of($projects)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                            $btn = "<a href='{{route('project.show')}}' class='edit btn btn-warning btn-sm'><ion-icon name='pencil-sharp'></ion-icon></a>
                                    <a href='' class='edit btn btn-info btn-sm'><ion-icon name='search-outline'></ion-icon></a>";

                            

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

        // if(request('search')){
        //     $projects->where('nama_instansi','like','%'. request('search'). '%');
        // }
        return view('project.index',compact('projects','product','priorittas','jobdesks','stattus','teknisis'))
            ->with('i',(request()->input('page', 1) - 1 ) * 5);
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

    public function search(Request $request)
    {
        $search = $request->search;

        $projects = Project::latest()->where('nama_instansi','like','%'.$search.'%')
                                    ->paginate(10);

        return view('project.index',compact('projects'));
    }

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
            // 'foto.*' => 'required|image|mimes:jpeg,jpg,png,svg,gif|max:2048',
            // 'foto.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048',
            'item' => 'required',
            'tgl_pengiriman' => 'required',
            'status1' => 'required',
            'tgl_kembali' => 'required|after:tgl_pengiriman',
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
            'status2' => $request->status2,
            'comment' => $request->comment
            ]);

            // if($request->hasfile('foto')){
            //     foreach($request->file('foto') as $file)
            //     {
            //         $name = $file->getClientOriginalName();
            //         $file->move(public_path('images'). "/images/$name");
            //         $data['foto'] = $name;
                
            //     $fileModal = new Project();
            //     $fileModal->foto = json_encode($data);

            //     $fileModal->save();
            //     }
            // }
            
        // if($request->file('foto')){

        //     $file = $request->file('foto');            
        //     $filename = $file->getClientOriginalName();
        //     $file->move(public_path('images'),"/images/$filename");
        //     $data['foto'] = $filename;

        //     $fileModal->name = json_encode($data);
        //     $fileModal->foto_path = json_encode($data);
        // } 

        DB::transaction(function () use ($data) {
            // $data->save();
            // looping foto
            foreach ($request->file('foto') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('images'). "/images/$name");
                $data['foto'] = $name;
            
            // simpan
            $foto = new Project();
            $foto->foto = json_encode($data);
            $data->save();
            }
        });

        toast('Berhasil Menambah','success');
        return redirect()->route('project.index');
                
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project = Project::find(1);
        $fotos = $project->foto;
        foreach($fotos as $foto){
            
        }
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
        // return view('project.edit',compact('project','product','priorittas','jobdesks','stattus','projects','teknisis'));
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
            // 'foto' => 'image|file|max:2048',
            'item' => 'required',
            'tgl_pengiriman' => 'required',
            'status1' => 'required',
            'tgl_kembali' => 'required',
            'status2' => 'required'
        ]);

        // if($request->file('image')){
        //     $request->foto['image'] = $request->file('image')->update('images'); 
        // }

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
            'status2' => $request->status2,
            'comment' => $request->comment
        ]);

        if($request->file('foto')){
            $file = $request->file('foto');
            // $random = Str::random(10);
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images'),"/images/$filename");
            $data['foto'] = $filename;
        } 

        $data->save();

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