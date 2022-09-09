<?php

namespace App\Http\Controllers;

use App\Models\{ Produk,Prioritas,Jobdesk,Status,Teknisi };
use App\Models\Project;
use App\Exports\DataExport;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if(!empty($search)) {
            $data = Project::latest()->sortable()
            ->where('project.nama_instansi','like','%'. $search . '%')
            ->orWhere('project.nama_teknisi','like','%'. $search . '%')
            ->paginate(10)->onEachSide(2)->fragment('data');
        }else{
            $projects = Project::latest()->sortable()->paginate(10)->onEachSide(2)->fragment('data');
        }


        $product = Produk::all();
        $priorities = Prioritas::all();
        $jobdesks = Jobdesk::all();
        $stattus = Status::all();
        // $projects = Project::sortable()->paginate(5)->onEachSide(2)->fragment('data');
        $teknisis = Teknisi::all();

        return view('project.index',compact('product','priorities','jobdesks','stattus','teknisis','projects'))
            ->with([
                'projects' => $projects,
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
        // $product = Produk::all();
        // $priorittas = Prioritas::all();
        // $jobdesks = Jobdesk::all();
        // $stattus = Status::all();
        // $projects = Project::all();
        // $teknisis = Teknisi::all();
        // return view('project.create',compact('product','priorittas','jobdesks','stattus','projects','teknisis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $request->validate([
            'nama_instansi' => 'required',
            'nama_lokasi' => 'required',
            'nama_teknisi' => 'required',
            'produk' => 'required',
            'warranty' => 'required',
            'priority' => 'required',
            'jobdesk' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            // 'foto.*' => 'required|image|mimes:jpeg,jpg,png,svg,gif|max:2048',
            // 'foto.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048',
            'item' => 'required',
            
        ]); 

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/'),"/$imageName");

        Project::create([
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
                // 'foto' => implode(',',$request->foto),
                'image' => $request->image->getClientOriginalName(),
                'item' => $request->item,
                'tgl_pengiriman' => $request->tgl_pengiriman,
                'status1' => $request->status1,
                'tgl_kembali' => $request->tgl_kembali,
                'status2' => $request->status2,
                'comment' => $request->comment  
            ]);

            // if($request->file('foto')){

            //     $file = $request->file('foto');
            //     $filename = $file->getClientOriginalName();
            //     $file->move(public_path('images')."/$filename");
            //     $data['foto'] = $filename;
    
            //     $data->save();
            // } 
      
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
            'image' => 'mimes:jpg,jpeg,png,svg,gif|max:2048',
            'item' => 'required',
        ]);

        // $image = $request->file('image');
        // $imageName = $image->getClientOriginalName();
        // $image->move(public_path('images/'),"/$imageName");
        // $image->update('images');

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
            'image' => $request->image,
            'item' => $request->item,
            'tgl_pengiriman' => $request->tgl_pengiriman,
            'status1' => $request->status1,
            'tgl_kembali' => $request->tgl_kembali,
            'status2' => $request->status2,
            'comment' => $request->comment
        ]);

        // if($request->file('image')){
        //     $file = $request->file('image');
        //     $filename = $file->getClientOriginalName();
        //     $file->move(public_path('images/'),"$filename");
        //     $data['image'] = $filename;
        // }else{
        //     unset($data['image']);
        // }

        // $project->update($data);

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