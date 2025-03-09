<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Media;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Show Category Index Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $categories = Category::orderByDesc('created_at')->paginate(6);
        $page_group = 'category';

        return view('categories.index')->with(compact('categories', 'page_group'));
    }

        
    /**
     * Show create a new category object page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(){
        return view('categories.create')->with('page_group', 'category');
    }


    /**
     * Store a new category object
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request){
        $category = new Category();

        $validatedData = $request->validate([
            'name' => ['required'],
            'description' => ['nullable'],
            'avatar_id' => ['nullable', 'numeric', 'exists:images,id']
        ]);

        $category = Category::create(array_merge(array_slice($validatedData,0,3), ['slug' => Str::of($validatedData['name'])->slug('_')]) );


        return redirect('/admin/category/');
    }


    /**
     * Show the edit page
     * @param \App\Models\Category $category
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function edit(Category $category){
        $page_group = 'category';

        return view('categories.edit')->with(compact('category', 'page_group'));
    }

    /**
     * Update a category object
     * @param \App\Models\Category $category
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Category $category, Request $request){

        $validatedData = $request->validate([
            'name' => ['required'],
            'description' => ['nullable'],
            'avatar_id' => ['required', 'numeric', 'exists:images,id']
        ]);

        $category->update(array_merge(array_slice($validatedData,0,3), ['slug' => Str::of($validatedData['name'])->slug('_')]));


        return  back();
    }


    /**
     * Delete a category
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Category $category){

        $category->delete();

        return redirect('/admin/category/');
    }

    /**
     * Show a category page
     * @param mixed $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($slug)  {
        $categoryShowed = Category::where('slug',$slug)->firstOrFail();
        $products = $categoryShowed->products()->paginate(8);

        return view('categories.view')->with(compact('categoryShowed', 'products'));
    }
}
