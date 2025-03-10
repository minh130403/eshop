@extends('admin.dashbroad')

@section('body')



    <div class="container-fluid mt-3">
        <h3>Tags</h3>
        <form class="d-flex" action="/admin/tag/" method="POST">
          @csrf
            <div class="container-fluid mt-3">
                <h3>Add a new Category</h3>
                <div class="row">
                 
                    <div class="col">
                            <div class="mb-3">
                                <label for="title" class="form-label">Tag's name</label>
                                <input type="text" class="form-control" id="" name="name">
                              </div>
                              <div class="mb-3 text-end">
                                <button type="submit" class="btn btn-primary">Post</button>
                            </div>
                    </div>    
                </div>
            </div>
          </form>  

        <div>
          <a class="btn btn-primary" href="/admin/tag/create"><i class="fa-solid fa-plus"></i> Add a New Tag</a>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @empty($tags)
                        <th class="text-center" scope="row" colspan="4"> <span class="text-danger "> There is no category</span></th>
                        @endempty

                        @foreach ($tags as $tag )
                        <tr>
                          <th scope="row" style="width:20px">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                              </div>
                          </th>
                          <td>{{ $tag->name }} <span class="badge text-bg-secondary">{{ $tag->loadCount('products')->products_count }}</span></td>
                          <td>
                            <a class="btn btn-primary" href="/admin/tag/{{ $tag->id ?? null }}"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="/admin/tag/{{ $tag->id ?? null }}" method="POST"  style="display: inline-block !important;">
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
                  {{ $tags->links() }}
            </div>
        </div>
    </div>
@endsection