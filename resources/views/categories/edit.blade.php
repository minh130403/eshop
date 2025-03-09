@extends('admin.dashbroad')

@section('body')
<form class="d-flex" action="" method="POST">
  @csrf
  @method('PUT')
    <div class="container-fluid mt-3">
        <h3>Edit Category</h3>
        <div class="row">
         
            <div class="col-9">
                    <div class="mb-3">
                        <label for="title" class="form-label">Category's Title</label>
                        <input type="text" class="form-control" id="" name="name" value="{{ $category->name }}">
                      </div>
                      <div class="mb-3">
                        <label for="title" class="form-label">Category's Description:</label>
                        <x-forms.tinymce-editor selector="editor" :value="$category->description" name="description"></x-forms.tinymce-editor> 
                      
                      </div>
                 
            </div>
            <div class="col-3">
                <div class="mb-3 text-end">
                  
                    <label id="avatarLabel" class="form-label" for="" data-bs-toggle="modal" data-bs-target="#mediaModal">
                        <div class="text-start" style="width:100%">Avatar:</div>   
                        @empty($category->avatar_id)
                        <div class="border rounded mt-2 d-flex justify-content-center align-items-center" style="height: 300px; width:250px">
                          <i class="fa-solid fa-plus"></i>
                      </div>
                        @endempty

                        @isset($category->avatar_id)
                        <img class="border rounded mt-2 " style="height: 300px; width:250px" src="{{ asset($category->avatar->src)}}" alt="{{ $category->avatar->alt }}">
                        @endisset
                      </label>
                    <input type="text" style="display: none" name="avatar_id" id="avatar_id" value="{{ $category->avatar->id  ?? null}}">
                </div>
                  
                <!-- Modal -->
                <div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="mediaModalLabel">Media</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row " style="height: 70vh">
                          <div class="col-8 border rounded media-list" style="height: 100%; overflow-y:scroll ;">
                              <div class="row row-cols-4 p-2" id="media-list">
                                  {{-- Render media l --}}
                              </div>
                          </div>
                          <div class="col-4 image-info border rounded" style="height: 100%">
                            <div action="" id="image-info">
                              <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <p class="border px-1 rounded" id="nameImage" style="height: 40px; line-height: 40px;" contenteditable="true"></p>
                              </div>
                              <div class="mb-3">
                                <label for="alt" class="form-label">Alt</label>
                                <p class="border px-1 rounded" id="altImage" style="height: 40px; line-height: 40px;" contenteditable="true"></p>
                              </div>
                              <div class="mb-3">
                                <span>Uploaded at: <span id="uploadedImage"></span> </span>
                              </div>
                              <div class="mb-3">
                                <span>Updated at: <span id="updatedImage"></span></span>
                              </div>
                              <div class="mb-3">
                                <span>Size: </span>
                              </div>
                            </div>

                            <a href="" class="text-danger">Delete</a>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="chooseImgBtn" data-bs-dismiss="modal">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>



                {{-- ---------------------------------------------- --}}
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </div>
    
            
        </div>
    </div>
  </form>  

  

@endsection