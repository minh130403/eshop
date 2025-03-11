@extends('admin.dashbroad')

@section('body')
<div class="container-fluid mt-3">
    <h3>Users</h3>
    <div class="row" id="users-index">
        <div class="col">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Email</th>
                      <th scope="col">Name</th>
                      <th scope="col">Level</th>
                      <th scope="col">State</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                      <th scope="row" style="width:20px">
                        <div class="form-check">
                            <input class="form-check-input check-box-action"  type="checkbox" value="" id="flexCheckDefault" data-id="{{ $user->id }}">
                          </div>
                      </th>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->name }}</td>
                      <td>
                        <form id="updateUser{{$user->id }}" action="/admin/users/{{ $user->id }}/update_state" method="POST" style="display: inline-block !important;">
                          @csrf
                          @method('PUT')
                          <select class="form-select" aria-label="Default select example" name="state">
                            <option value="2" {{ $user->level->id == 2 ? 'selected' : '' }}>User</option>
                            <option value="1" {{ $user->level->id == 1 ? 'selected' : '' }}>Admin</option>
                          </select>
                        </form>
                      </td>
                      <td style="text-transform: uppercase">{{ $user->state->name ?? '' }}</td>
                     
                      <td>  
                         <button class="updateUser btn btn-primary" data-form-update="updateUser{{$user->id }}" > <i class="fa-solid fa-floppy-disk"></i> </button> 
                         <script>
                         
                       </script>
                         <form action="/admin/users/{{ $user->id }}/delete" method="POST" style="display: inline-block !important;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary" ><i class="fa-solid fa-trash"></i> </button>
                       </form>
                       
                     </td>
                     <td>
                       
                     </td>
                    </tr>
                    @endforeach

                  </tbody>
              </table>
              <div class="row">
                 <div class="col-3">
                    <select class="form-select" aria-label="Default select example" id="action-selector">
                        <option selected>Open this select actions</option>
                        <option value="DELETE">Delete</option>
                        <option value="UPDATE">Update</option>
                      </select>
                 </div>
                 <div class="col">
                    <button type="button" class="btn btn-primary" id="multipleSubmitBtn">Do that</button>
                 </div>
              </div>
              {{ $users->links() }}
        </div>
    </div>
</div>
@endsection