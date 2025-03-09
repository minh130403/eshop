<?php

namespace App\Http\Controllers;

use App\Http\Resources\MediaCollection;
use App\Models\Media;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;




class MediaController extends Controller
{

    /**
     * Show media list
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function index(){
        $images = Media::all();
        $page_group = 'page_group';

        return view('media.index')->with(compact('images', 'page_group'));
    }


    /**
     * Show create media form
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function create(){
        return view('media.create')->with('page_group', 'media');
    }


    /**
     * Store a new media object
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request){
        $validateData = $request->validate(
            [
                'image' => ['file', 'image'],
                'name' => ['required'],
                'alt' => ['nullable']
            ]
        );

        $filePath = $request->file('image')->storeAs('images', Str::of($validateData['name'] . Carbon::now())->slug('-')  ,'public');

        Media::create(array_merge(array_slice($validateData, 1, 2), ['src' => $filePath]));
        

        return redirect('/admin/media');

    }

    /**
     * Show edit page 
     * @param \App\Models\Media $media
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function edit(Media $media){
        $page_group = 'media';

        return view('media.edit')->with(compact('media', 'page_group'));
    }


    /**
     * Update a media object
     * @param \App\Models\Media $media
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Media $media, Request $request){
        $validateData = $request->validate([
            'name' => ['required'],
            'alt' => ['nullable']
        ]);

        $media->update($validateData);
        
        return back();

       
    }

    /**
     * Destroy a media object
     * @param \App\Models\Media $media
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Media $media){
        $media->delete();
        return redirect('/admin/media');
    }


    
    /**
     * Get media list
     * @return MediaCollection
     */
    public function indexAPI(){
        $images = new MediaCollection(Media::all());
        return $images;
    }
    
}
