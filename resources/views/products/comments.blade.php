@extends('admin.dashbroad')

@section('body')
    <div class="container-fluid mt-3">
        <h3>Comments</h3>
        <div class="row">
            <div class="col">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Content</th>
                          <th scope="col">User</th>
                          <th scope="col">Product</th>
                          <th scope="col">State</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($comments as $comment)
                        <tr>
                          <th scope="row" style="width:20px">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                              </div>
                          </th>
                          <td>{{ $comment->content }}</td>
                          <td>{{ $comment->user->name }}</td>
                          <td>{{ $comment->product->name }}</td>
                          <td>
                            <form id="updateComment{{$comment->id }}" action="/admin/comment/{{ $comment->id }}/update_state" method="POST" style="display: inline-block !important;">
                              @csrf
                              @method('PUT')
                              <select class="form-select" aria-label="Default select example" name="state">
                                <option value="1" {{ $comment->state == 0 ? 'selected' : '' }}>Inactive</option>
                                <option value="0" {{ $comment->state == 1 ? 'selected' : '' }}>Active</option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <form action="/admin/products/comment/{{ $comment->id }}/remove" method="POST"  style="display: inline-block !important;">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-primary" type="submit"><i class="fa-solid fa-trash"></i> </button>
                            </form>
                        </td>
                        </tr>
                        @endforeach

                      </tbody>
                  </table>
                  <div class="row">
                     {{-- <div class="col-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select actions</option>
                            <option value="1">Delete</option>
                            <option value="2">Move to Trash</option>
                          </select>
                     </div>
                     <div class="col">
                        <button type="submit" class="btn btn-primary">Do that</button>
                     </div> --}}
                  </div>
                  {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection