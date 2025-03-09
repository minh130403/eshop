@extends('admin.dashbroad')

@section('body')
<div class="container-fluid mt-3">
    <h3>Edit file</h3>
    <div class="row">
        <div class="col-3 border rounded d-flex">
            <img src="{{ asset($media->src) }}" class="img-fluid" alt="{{ $media->alt }}">
        </div>
        <div class="col-9">
            <form action="/admin/media/{{ $media->id }}" method="POST" >
              @csrf
              @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $media->name }}">
                  </div>
                  <div class="mb-3">
                    <label for="alt" class="form-label">Alt</label>
                    <input type="text" class="form-control" id="alt" name="alt" value="{{ $media->alt }}">
                  </div>
                  <div class="mb-3">
                    <span>Src: {{ asset(  $media->src) }}</span>
                  </div>
                  <div class="mb-3">
                    <span>Upload at: {{ $media->created_at }} </span>
                  </div>
                  <div class="mb-3">
                    <span>Update at: {{ $media->updated_at }} </span>
                  </div>
                  <div class="mb-3">
                   
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
            </form>
            <form action="/admin/media/{{ $media->id }}"  method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection