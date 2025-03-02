@extends('admin.dashbroad')

@section('body')
<div class="container-fluid mt-3">
    <h3>Users</h3>
    <div class="row">
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
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
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
                      <td style="text-transform: uppercase">{{ $user->state->name ?? '' }}</td>
                     
                      <td>  
                         <button class="updateUser btn btn-primary" data-form-update="updateUser{{$user->id }}" > <i class="fa-solid fa-floppy-disk"></i> </button> 
                         <script>
                          var updateBtnUserState = document.querySelectorAll('.updateUser');

                          updateBtnUserState.forEach(btn => {
                              btn.onclick = function(){
                                document.querySelector('#' + this.dataset.formUpdate).submit();
                              }
                          });
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
              {{ $users->links() }}
        </div>
    </div>
</div>
@endsection