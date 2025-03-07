import 'bootstrap'


var app = { 
    run : function(){
        document.addEventListener('DOMContentLoaded', function(){
            var mediaListElement = document.querySelector('#media-list');

            if(mediaListElement){
                this.renderMedia(mediaListElement);
            }
            
        })
    },
    renderMedia : async function(){ 
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
}


