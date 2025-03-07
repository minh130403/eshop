<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Media;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::all();
        return view('categories.index', [
            'categories' => $categories,
            'page_group' => 'category',
        ]);
    }

    public function add(){
        return view('categories.add', [
            'page_group' => 'category',
            
        ]);
    }

    public function store(Request $request){
        $newCategory = new Category();
        $newCategory->name = $request->name;
        $newCategory->description = $request->description;
        $newCategory->slug = Str::of($newCategory->name)->slug('_');
        $avatar = Media::find($request->avatar_id);

        $avatar->categories()->save($newCategory);

        return redirect('/admin/category/');
    }

    public function edit($id){
        $editCategory = Category::find($id);
        return view('categories.edit',[
            'category' => $editCategory,
            'page_group' => 'category',

        ]);
    }

    public function update($id, Request $request){
        $updateCategory = Category::find($id);
        $updateCategory->name = $request->name;
        $updateCategory->description = $request->description;
        $updateCategory->slug = Str::of($updateCategory->name)->slug('_');
        $avatar = Media::find($request->avatar_id);

        $avatar->categories()->save($updateCategory);

        return redirect('/admin/category/');
    }


    public function delete(Category $category){
        $category->delete();

        return redirect('/admin/category/');
    }

    public function show($slug)  {
        $category = Category::where('slug',$slug)->firstOrFail();
        $products = $category->products()->paginate(8);
        return view('categories.view', [
            'categoryShowed' => $category,
            'products' => $products
        ]);
    }
}
