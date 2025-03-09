@extends('admin.dashbroad')

@section('body')
<form class="d-flex" action="/admin/product" method="POST" id="productForm">
  @csrf
    <div class="container-fluid mt-3">
        <h3>Add a new product</h3>
        <div class="row">
            <div class="col-9">
                    <div class="mb-3">
                        <label for="title" class="form-label">Product's Title</label>
                        <input type="text" class="form-control" id="" name="name" >
                      </div>
                      <div class="mb-3">
                        <label for="shortDescriptionEditor" class="form-label">Product's Short Description:</label>
                           <x-forms.tinymce-editor selector="editor" id="short_description" name="short_description" ></x-forms.tinymce-editor>
                      </div>
                      <div class="mb-3">
                        <label for="descriptionEditor" class="form-label">Product's Description:</label>
                        <x-forms.tinymce-editor selector="editor" id="description_tiny" name="description_tiny"></x-forms.tinymce-editor>
                        <textarea name="description" id="" style="display: none"></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="title" class="form-label">Categories:</label>
                        <ul class="list-group border rounded" style="max-height: 200px; overflow-y:scroll;">
                            @foreach ($categories as $category)
                            <li class="list-group-item">
                                
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="{{ $category->id }}" name="categories[]" id="categoryID" >
                                  <label class="form-check-label" for="categoryID">
                                    {{ $category->name }}
                                  </label>
                                </div>
                          </li> 
                            @endforeach

                          </ul>
                      </div>
                      <div >
                        <label class="form-label">Price:</label>
                      </div>
                      <div class="input-group mb-3">
                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"  aria-describedby="basic-addon2" min="0" max="100000000000">
                        <span class="input-group-text" id="basic-addon2">VNĐ</span>
                       
                      </div>
                      @error('price')
                      <div class="alert alert-danger">{{ $message }}</div>
                       @enderror
                      <div >
                        <label class="form-label">Tags: (Mỗi tag cách nhau bởi 1 dấu chấm phẩy)</label>
                        <input type="text" class="form-control" >
                      </div>
            
            </div>
            <div class="col-3">
                <div class="mb-3 text-end">
                    <label id="avatarLabel" class="form-label" for="" data-bs-toggle="modal" data-bs-target="#mediaModal">
                      <div class="text-start" style="width:100%">Avatar:</div>  
                      <div class="border rounded mt-2 d-flex justify-content-center align-items-center" style="height: 300px; width:250px">
                          <i class="fa-solid fa-plus"></i>
                      </div>
                    </label>
                    <input type="text" style="display: none" name="avatar_id" id="avatar_id">
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
                                  @for ($i = 0; $i < 16; $i++)
                                  <div class="col mb-2">
                                    <label for="radio{{ $i }}"><img id="img{{$i }}" class=" border rounded " style="height: 100%; width:100%" src="https://th.bing.com/th/id/OIP.SUA8N47Q2yLwM8s6cXlkmAHaHO?rs=1&pid=ImgDetMain" alt=""></label>
                                    <input type="radio" name="radio" id="radio{{ $i }}" data-id="img{{ $i }}">
                                  </div>
                                  @endfor
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


