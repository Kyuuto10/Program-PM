<?php

namespace App\Http\Controllers;

use App\Models\{ Produk,Prioritas,Jobdesk,Status,Teknisi,Image,Comment,User };
use App\Models\Data;
use App\Exports\DataExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$projects['nama_instansi'] = request('nama_instansi');
        $projects['filter'] = request('filter');
        $projects['select_teknisi'] = $request->query('select_teknisi');
        $projects['select_produk'] = $request->query('select_produk');
        $projects['select_prioritas'] = $request->query('select_prioritas');
        $projects['select_status_pekerjaan'] = $request->query('select_status_pekerjaan');
        $projects['select_jobdesk'] = $request->query('select_jobdesk');
        $projects['date'] = $request->query('date');
        $projects['select'] = $request->query('select');
        $projects['status'] = $request->query('status');    
        $projects['keyword'] = $request->query('keyword');  

        $query = Data::join('teknisi','data.id_teknisi','=','teknisi.id')
                    ->join('status','data.id_status','=','status.id')
                    ->join('produk','data.id_produk','=','produk.id')
                    ->join('prioritas','data.id_prioritas','=','prioritas.id')
                    ->join('jobdesk','data.id_jobdesk','=','jobdesk.id')              
                    ->join('users','data.id_user','=','users.id')
                    //->leftJoin('images','data.id','=','images.data_id')
                    ->where(function($query)use($projects){
                        /*$query->where('nama_instansi','LIKE','%'.$projects['keyword'].'%');
                        $query->orWhere('nama_produk','LIKE','%'.$projects['keyword'].'%');
                        $query->orWhere('nama_teknisi','LIKE','%'.$projects['keyword'].'%');*/
                        if($projects['filter'] == "nama_instansi"){
                            $query->where('nama_instansi','LIKE','%'.$projects['keyword'].'%');
                        }else if($projects['filter'] == "nama_lokasi"){
                            $query->where('nama_lokasi','LIKE','%'.$projects['keyword'].'%');
                        }else if($projects['filter'] == "produk"){
                            $query->where('nama_produk','=',$projects['select_produk']);
                        }else if($projects['filter'] == "teknisi"){
                            $query->where('nama_teknisi','=',$projects['select_teknisi']);
                        }else if($projects['filter'] == "tanggal"){
                            $query->where('tanggal','LIKE','%'.$projects['date'].'%');
                        }else if($projects['filter'] == "warranty"){
                            $query->where('warranty','=',$projects['select']);
                        }else if($projects['filter'] == "prioritas"){
                            $query->where('nama_prioritas','=',$projects['select_prioritas']);
                        }else if($projects['filter'] == "jobdesk"){
                            $query->where('nama_jobdesk','=',$projects['select_jobdesk']);
                        }else if($projects['filter'] == "status"){
                            $query->where('nama_status','=',$projects['select_status_pekerjaan']);
                        }else if($projects['filter'] == "item"){
                            $query->where('item','LIKE','%'.$projects['keyword'].'%');
                        }else if($projects['filter'] == "tgl_pengiriman"){
                            $query->where('tgl_pengiriman','LIKE','%'.$projects['keyword'].'%');
                        }else if($projects['filter'] == "status_pengiriman"){
                            $query->where('status_pengiriman','=',$projects['status']);
                        }else if($projects['filter'] == "tgl_kembali"){
                            $query->where('tgl_kembali','LIKE','%'.$projects['keyword'].'%');
                        }else if($projects['filter'] == "status_kembali"){
                            $query->where('status_kembali','=',$projects['status']);
                        }else if($projects['filter'] == "semua"){
                            $query->where('nama_instansi','LIKE','%'.$projects['keyword'].'%');
                            $query->orWhere('nama_lokasi','LIKE','%'.$projects['keyword'].'%');
                            $query->orWhere('nama_teknisi','LIKE','%'.$projects['keyword'].'%');
                            $query->orWhere('nama_produk','LIKE','%'.$projects['keyword'].'%');                            
                            $query->orWhere('nama_prioritas','LIKE','%'.$projects['keyword'].'%');
                            $query->orWhere('nama_jobdesk','LIKE','%'.$projects['keyword'].'%');
                            $query->orWhere('nama_status','LIKE','%'.$projects['keyword'].'%');
                            $query->orWhere('item','LIKE','%'.$projects['keyword'].'%');                           
                        }
                    })
                    /*->when(request('nama_instansi'),function($query)use($projects){
                            $query->where('nama_instansi',$projects['nama_instansi']); 
                            
                    })*/
                    ->select('data.*',
                            'teknisi.nama_teknisi',
                            'produk.nama_produk',
                            'prioritas.nama_prioritas',
                            'jobdesk.nama_jobdesk',
                            'status.nama_status',
                            //'images.image',
                            'users.name')
                    ->groupBy('id')
                    ->orderBy('data.id','desc')
                    ->paginate(10);        

        $projects = $query->withQueryString();

        /*$query = "SELECT d.*, t.nama_teknisi, pk.nama_produk, ps.nama_prioritas, j.nama_jobdesk, s.nama_status, i.image, u.name
            FROM data AS d
            INNER JOIN teknisi AS t ON d.id_teknisi = t.id
            INNER JOIN produk AS pk ON d.id_produk = pk.id
            INNER JOIN prioritas AS ps ON d.id_prioritas = ps.id
            INNER JOIN jobdesk AS j ON d.id_jobdesk = j.id
            INNER JOIN status AS s ON d.id_status = s.id
            LEFT JOIN images AS i ON d.id = i.data_id
            INNER JOIN users AS u ON d.id_user = u.id
            -- GROUP BY d.id
            ORDER BY d.id DESC";
        $datas = DB::select($query);
        return $datas;*/

        $product = Produk::all();
        $priorities = Prioritas::all();
        $jobdesks = Jobdesk::all();
        $stattus = Status::all();
        $teknisis = Teknisi::all();
        $images = Image::all();
        $comments = Comment::join('users','comment.id_user','=','users.id')
                    ->select('comment.*','users.name')
                    ->get();
        $users = User::all();

        return view('project.index',compact('users','product','priorities','jobdesks','stattus','teknisis','projects','images','comments'))
        ->with([
            'data' => $projects 
        ]);

    }

    public function export()
    {
        return Excel::download(new DataExport, 'Data.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
                      
    $rules =  [
        'nama_instansi' => 'required',
        'nama_lokasi' => 'required',
        'id_teknisi' => 'required',
        'id_produk' => 'required',
        'warranty' => 'required',
        'id_prioritas' => 'required',
        'id_jobdesk' => 'required',
        'id_status' => 'required',                
        'item' => 'required',                
    ]; 
    $message = [
        'nama_instansi.required' => 'Nama Masih Kosong',
        'nama_lokasi.required' => 'Lokasi Masih Kosong',
        'id_teknisi.required' => 'Teknisi Masih Kosong',
        'id_produk.required' => 'Produk Masih Kosong',
        'warranty.required' => 'Garansi Masih Kosong',
        'id_prioritas.required' => 'Prioritas Masih Kosong',
        'id_jobdesk.required' => 'Jobdesk Masih Kosong',
        'id_status.required' => 'Status Masih Kosong',    
    ];

    // run validasi
    $validator = Validator::make($request->all(), $rules,$message);

    // cek validasi
    if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput($request->all());
    }

        // $image = $request->file('image');
        // $imageName = $image->getClientOriginalName();
        // $image->move(public_path('images/'),"/$imageName");       

        $project = Data::create([
                'tanggal' => Carbon::today(),
                'nama_instansi' => $request->input('nama_instansi'),
                'nama_lokasi' => $request->input('nama_lokasi'),
                'id_teknisi' => $request->input('id_teknisi'),
                'id_produk' => $request->input('id_produk'),
                'warranty' => $request->input('warranty'),
                'id_prioritas' => $request->input('id_prioritas'),
                'id_jobdesk' => $request->input('id_jobdesk'),
                'deskripsi' => $request->deskripsi,
                'id_status' => $request->input('id_status'),            
                'item' => $request->item,
                'tgl_pengiriman' => $request->tgl_pengiriman,
                'status_pengiriman' => $request->status_pengiriman,
                'tgl_kembali' => $request->tgl_kembali,
                'status_kembali' => $request->status_kembali,
                'id_user' => (auth()->user()->id),
                'date_modified' => Carbon::today() 
            ]); 

            if($request->has('image')){
                foreach($request->file('image')as $image){
                    $imageName = $project['nama_instansi'].'-image-'.time().rand(1,1000).'.'.$image->extension();
                    $image->move(public_path('images'),$imageName);
                    Image::create([
                        'data_id'=>$project->id,
                        'image'=>$imageName
                    ]);
                }
            }

            if(isset($request->komentar)){
                Comment::create([
                    'id_data'=>$project->id,
                    'komentar'=>$request->komentar,
                    'id_user' => (auth()->user()->id)
                ]);
            }
        
        toast('Berhasil tambah data','success');
        return redirect()->route('project.index');
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
       //dd($request);
        $request->validate([            
            'id_teknisi' => 'required',
            'id_produk' => 'required',            
            'id_prioritas' => 'required',
            'id_jobdesk' => 'required',            
            'id_status' => 'required',                    
        ]);         

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
            'item' => $request->item,
            'tgl_pengiriman' => $request->tgl_pengiriman,
            'status_pengiriman' => $request->status_pengiriman,
            'tgl_kembali' => $request->tgl_kembali,
            'status_kembali' => $request->status_kembali,
            'id_user' => (auth()->user()->id),
            'date_modified' => Carbon::today()
        ]);
        

        if($request->has('image')){
            foreach($request->file('image')as $image){
                $imageName = $project['nama_instansi'].'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('images'),$imageName);
                Image::create([
                    'data_id'=>$project->id,
                    'image'=>$imageName
                ]);
            }
        }

        toast('Berhasil edit data','success');
        return redirect()->route('project.index');
    }

    public function add_comment(Request $request, Data $project)
    {
        Comment::create([
            'id_data' => $request->id_data,
            'komentar' => $request->komentar,              
            // 'image' => $image,         
            // 'image' => implode("|",$image),
            'id_user' => (auth()->user()->id)
        ]);    

        toast('Berhasil tambah komentar','success');
        return redirect()->route('project.index',compact('project'));
    }

    public function download(Image $id)
    {
        $download = Image::all()->find($id);
        return response()->download('public/images/'.$download->image); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteImage(Request $request)
    {
        $id = $request->input('multi_delete');

        if($id == 0){
            toast('Silakan pilih foto terlebih dahulu');
            return back();
        }else{
        //hapus foto di folder
        foreach($id as $id_img){
            $images = DB::select('SELECT image FROM images WHERE id = '.$id_img);
            foreach($images as $img){
                if(File::exists('images/'.$img->image)){
                    File::delete('images/'.$img->image);
                }
            }
        }
    }

        //hapus foto di database
        Image::whereIn('id', $id)->delete();

        toast('Berhasil hapus foto','success');
        return back();
    }

    public function destroy($id)
    {
        //
    }
}