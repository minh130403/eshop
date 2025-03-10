<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagCollection;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{

    /**
     * Show index tags page
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function index(){
        $tags = Tag::orderByDesc('created_at')->paginate(10) ?? null;
        $page_group = 'product';
        
        return view('tags.index')->with(compact('tags', 'page_group')); 
    }

    public function indexAPI(){
        $tags = Tag::all();

        return new TagCollection($tags);
    }

    /**
     * Show create tag page
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function create() {
        $page_group = 'product';

        return view('tags.create')->with(compact('page_group'));
    }


    /**
     * Store a new tag
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request){
        $validateData = $request->validate(['name' => 'required|unique:tags']);
        $validateData['slug'] = Str::of($validateData['name'] )->slug('_');   

        Tag::create($validateData);

        return redirect('/admin/tag');
    }


    /**
     * Store a new tag API
     * @param \Illuminate\Http\Request $request
     * @return TagResource
     */
    public function storeAPI(Request $request)  {
        $validateData = $request->validate([
            'name' => 'required|unique:tags'
        ]);

        $validateData['slug'] = Str::of($validateData['name'] )->slug('_');   

        $tag = Tag::create($validateData);


        return new TagResource($tag);

    }


    /**
     * Show edit page
     * @param \App\Models\Tag $tag
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function edit(Tag $tag){
        $page_group = 'product';   

        return view('tags.edit')->with(compact('tag', 'page_group'));
    }


    /**
     * Update a tag
     * @param \App\Models\Tag $tag
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Tag $tag, Request $request){
        $validateData = $request->validate(['name' => 'required|unique:tags']);

        Tag::create($validateData);

        return back();
    }

    /**
     * Delete a tag
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Tag $tag){
        $tag->delete();

        return redirect('/admin/tag');
    }



    /**
     * Show a tag page
     * @param mixed $slug
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function show($slug){
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $products = $tag->products()->paginate(8);

        return view('tags.show')->with(compact('tag', 'products'));

    }

}
