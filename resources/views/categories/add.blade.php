@extends('admin.dashbroad')

@section('body')
<form class="d-flex" action="/admin/category/store" method="POST">
  @csrf
    <div class="container-fluid mt-3">
        <h3>Add a new Category</h3>
        <div class="row">
         
            <div class="col-9">
                    <div class="mb-3">
                        <label for="title" class="form-label">Category's Title</label>
                        <input type="text" class="form-control" id="" name="name">
                      </div>
                      <div class="mb-3">
                        <label for="title" class="form-label">Category's Description:</label>
                        <x-forms.tinymce-editor/>   
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

    <script>
        var mediaListElement = document.querySelector('#media-list');

      
        async function renderMedia(){
          const  url = 'http://localhost:8000/api/media/all'
          try {
            const response = await fetch(url);
            console.log('Hello')
            const json = await response.json();
            const images = json.data;

            var list = ''

            images.forEach(image => {
              list = list + `<div class="col mb-2">
                                    <label for="radio${image.id}"><img class=" border rounded " style="height: 200px; width:160px" src="http://localhost:8000/${image.src}" alt="${image.alt}"></label>
                                    <input type="radio" name="radio" id="radio${image.id}" data-id="${image.id}">
                                  </div>`
            });

            mediaListElement.innerHTML = list;


            var inputImages = mediaListElement.querySelectorAll('input');
            var imageSelected;
            
            inputImages.forEach(input => {
              input.onchange = function(){
                  if(input.checked){
                    imageSelected = images.find(image => image.id == input.dataset.id)
                    var formEdit = document.querySelector('#image-info');

                    formEdit.querySelector('#nameImage').innerText = imageSelected.name;
                    formEdit.querySelector('#altImage').innerText = imageSelected.alt;
                    formEdit.querySelector('#uploadedImage').innerText = imageSelected.created_at;
                    formEdit.querySelector('#updatedImage').innerText = imageSelected.updated_at;
                    // console.log(image)
                  }
              }
            })


            const chooseModalBtn = document.querySelector('#chooseImgBtn');

            chooseModalBtn.onclick = function() {
              var avatarLabel = document.querySelector('#avatarLabel');
              avatarLabel.innerHTML = `<div class="text-start" style="width:100%">Avatar:</div>  
                      <img class="border rounded mt-2 " style="height: 300px; width:250px" src="http://localhost:8000/${imageSelected.src}" alt="${imageSelected.alt}">                
                `;

              document.querySelector('#avatar_id').value = imageSelected.id;
            }
            
          } catch (error) {
            console.error(error.message);
          }
        }

        renderMedia();
        
    </script>

@endsection