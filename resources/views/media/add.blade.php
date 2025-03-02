@extends('admin.dashbroad')

@section('body')
<div class="container-fluid mt-3">
    <h3>Upload file</h3>
    <div class="row">
        <div class="col">
            <form action="/admin/media/store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="image" class="form-label">Default file input example</label>
                    <input class="form-control" type="file" id="image" name="image">
                  </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="alt" class="form-label">Alt</label>
                    <input type="text" class="form-control" id="alt" name="alt">
                </div>
                <button type="submit" class="btn btn-primary">Post</button>
              </form>
        </div>
    </div>
</div>
@endsection