@extends('admin.dashbroad')

@section('body')
    <div class="container-fluid mt-3">
        <h3>Categories</h3>
        <div>
          <a class="btn btn-primary" href="/admin/category/create"><i class="fa-solid fa-plus"></i> Add a New Category</a>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Avatar</th>
                          <th scope="col">Name</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @empty($categories)
                        <th class="text-center" scope="row" colspan="4"> <span class="text-danger "> There is no category</span></th>
                        @endempty

                        @foreach ($categories as $category )
                        <tr>
                          <th scope="row" style="width:20px">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                              </div>
                          </th>
                          <td style="width:60px"> <img class="border rounded img-fluid" 
                            @isset($category->avatar->src) src="{{ asset($category->avatar->src) }}" alt="{{ $category->avatar->alt }}" @endisset 
                            @empty($category->avatar->src) src="https://png.pngtree.com/png-clipart/20230823/original/pngtree-illustration-of-set-different-dairy-milk-products-picture-image_8225323.png" @endempty 
                            >
                          </td>
                          <td>{{ $category->name }}</td>
                          <td>
                            <a class="btn btn-primary" href="/admin/category/{{ $category->id }}"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="/admin/category/{{ $category->id }}" method="POST"  style="display: inline-block !important;">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-primary" type="submit"><i class="fa-solid fa-trash"></i> </button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                  {{-- <div class="row">
                     <div class="col-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select actions</option>
                            <option value="1">Delete</option>
                            <option value="2">Move to Trash</option>
                          </select>
                     </div>
                     <div class="col">
                        <button type="submit" class="btn btn-primary">Do that</button>
                     </div>
                  </div> --}}
                  {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection