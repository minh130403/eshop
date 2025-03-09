import 'bootstrap'


var app = { 
    run : function(){
        document.addEventListener('DOMContentLoaded', function(){

            // Media 
            var mediaListElement = document.querySelector('#media-list');
            var productForm = document.getElementById('productForm');

            if(mediaListElement){
                app.renderMedia(mediaListElement);
            }

            if(productForm){
                app.fetchProductFormData(productForm);
            }

            
        })
    },
    renderMedia : async function(mediaListElement){ 
        const  url = 'http://localhost:8000/api/media/'
        try {
            const response = await fetch(url);
            console.log('Hello')
            const json = await response.json();
            const images = json.data;

            var list = ''

            images.forEach(image => {
            list = list + `<div class="col mb-2">
                                    <label class="w-100 h-100" for="radio${image.id}"><img class="border rounded img-fluid object-fit-scale"  src="http://localhost:8000/${image.src}" alt="${image.alt}" style="max-height:100px; width:100%"></label>
                                    <input type="radio" name="radio" id="radio${image.id}" data-id="${image.id}" style="display:none;">
                                </div>`
            });


            mediaListElement.innerHTML = list;


            var inputImages = mediaListElement.querySelectorAll('input');
            var imageSelected;
            
            inputImages.forEach(input => {
            input.onchange = function(){

                inputImages.forEach(x => {
                    var label = document.querySelector(`label[for="${x.id}"]`)
                    var image = label.querySelector('img')
                    image.classList.remove('border-secondary', 'border-2');

                })

                
                if(input.checked){
                    var label = document.querySelector(`label[for="${input.id}"]`)
                    var image = label.querySelector('img')
                    image.classList.remove('border-secondary', 'border-2');
                    imageSelected = images.find(image => image.id == input.dataset.id)
                    var formEdit = document.querySelector('#image-info');
                   
                    image.classList.add('border-secondary', 'border-2');

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
    }, 
    fetchProductFormData(productForm){
        productForm.addEventListener('submit', function(e) {
            e.preventDefault();
            tinymce.triggerSave();
          
            var description_tiny = document.querySelector('textarea[name="description_tiny"]');
            var description =  document.querySelector('textarea[name="description"]');
            description.value = description_tiny.value;
            this.submit();
           
        });    
    }
}



app.run();

