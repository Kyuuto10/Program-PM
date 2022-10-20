<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Data;
use App\Models\Image;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function uploadImage(Request $request, Data $project)
    {
        //dd($request);
        $request->validate([
            'image' => 'max:2048'
        ]);

        // $images = $request->file('image');
        // if($request->hasFile('image')){
        //     foreach($images as $image){
                
        //         $imageName = $project['nama_instansi'].'-image-'.$image->getClientOriginalName();
        //         $image->move(public_path('images'),$imageName);
        //         $arr[] = $imageName;
        //     }
        //     $images = implode(",", $arr);
        // }else{
        //     $images = '';
        // }

       $comment = Comment::create([
            'id_data' => $request->id_data,
            'komentar' => $request->komentar,            
            'id_user' => (auth()->user()->id)
        ]);

        if($request->has('image')){
            foreach($request->file('image')as $image){
                $imageName = $project['nama_instansi'].'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('images'),$imageName);
                Image::create([
                    'data_id'=>$request->id_data,
                    'comment_id'=>$comment->id,
                    'image'=>$imageName
                ]);
            }
        }        

        toast('Berhasil tambah komentar','success');
        return redirect()->route('project.index');
    }
}
