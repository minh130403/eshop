@extends('admin.dashbroad')

@section('body')
<div class="container-fluid mt-3">
    <h3>Images</h3>
    <div class="row">
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
                @foreach ($images as $image)
                <tr>
                  <th scope="row" style="width:20px">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      </div>
                  </th>
                  <td style="width:60px; "> <img class="border rounded img-fluid" style="width:60px; height: 60px;" src="{{ asset($image->src) }}"  alt="{{ $image->alt }}"> </td>
                  <td>{{ $image->name }}</td>
                  <td>
                    <a type="button" class="btn btn-primary" href="/admin/media/edit/{{ $image->id }}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <button type="button" class="btn btn-primary"><i class="fa-solid fa-trash"></i> </button>
                </td>
                </tr>
                @endforeach
                

              
              </tbody>
          </table>
    </div>
</div>
@endsection