<?php

namespace App\Http\Controllers;

use App\Models\Media;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;




class MediaController extends Controller
{
    public function index(){
        $images = Media::all(); 
        return view('media.index', [
            'page_group' => 'media',
            'images' => $images
        ]);
    }

    public function add(){
        return view('media.add', [
            'page_group' => 'media',
        ]);
    }

    public function store(Request $request){


        if ($request->hasFile('image')) {
            $newImage = new Media();
            $newImage->name = $request->input('name');
            $newImage->alt = $request->input('alt');
            $newImage->src = $request->file('image')->storeAs('images', Str::of($newImage->name . Carbon::now())->slug('-')  ,'public');
            $newImage->save();

            return view('media.edit',[
                'image' => $newImage,
                'page_group' => 'media',
            ]);
        }

        return back();
    }

    public function edit($id){
        $image = Media::find($id);
        return view('media.edit', [
            'image' => $image,
            'page_group' => 'media',
        ]);
    }

    public function update($id, Request $request){
        $image = Media::find($id);
        if($image){
            $image->name = $request->input('name');
            $image->alt = $request->input('alt');
            $image->save();
            
            return view('media.edit', [
                'image' => $image,
                'page_group' => 'media',
            ]);
        }

        return back();
       
    }

    public function destroy($id){
        $image = Media::find($id);
        if($image){
            Storage::disk('public')->delete( $image->src);
            $image->delete();
            return redirect('/admin/media')->with('mess', 'Da xoa thanh cong ');
        }
        return back();
    }


    
    public function allApi(){
        $images = Media::all(); 
        return response([
            'data' => $images,
            'status' => 200
        ], 200);
    }
    
}
