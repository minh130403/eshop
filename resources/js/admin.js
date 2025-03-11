import 'bootstrap'


var app = { 
    run : function(){
        document.addEventListener('DOMContentLoaded', function(){

            // Media 
            var mediaListElement = document.querySelector('#media-list');
            var productForm = document.getElementById('productForm');
            var userPage = document.getElementById('users-index');

            if(mediaListElement){
                app.renderMedia(mediaListElement);
            }

            if(productForm){
                app.fetchProductFormData(productForm);
            }

            if(userPage){
                app.updateUserfromAdmin();
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
    },
    updateUserfromAdmin(){
        var updateBtnUserState = document.querySelectorAll('.updateUser');
        var selectActionElement = document.querySelector('#action-selector');
        var multipleSubmitBtn = document.querySelector('#multipleSubmitBtn');

        updateBtnUserState.forEach(btn => {
            btn.onclick = function(){
              document.querySelector('#' + this.dataset.formUpdate).submit();
            }
        });

        var actionSelected;

        selectActionElement.onchange = function(){
            actionSelected = selectActionElement.value;
        }

        multipleSubmitBtn.onclick = function(){
            var usersCheckboxSelected  = document.querySelectorAll('.check-box-action:checked');
            var usersID= [];

            usersCheckboxSelected.forEach(userCheckBox => {
                usersID.push(+userCheckBox.dataset.id);
            })



            if(actionSelected == 'DELETE'){
                var form = new FormData();
                // form.append('name', 'Minh')

                // console.log(usersID)
                usersID.forEach(id => {
                    form.append('id_arrays', id);
                })
                console.log(form)

            

                fetch('http://localhost:8000/api/users/multiple-delete',{
                    method: 'delete',
                    headers: {
                        'Content-Type': 'application/json'   
                    },
                    body: JSON.stringify({ id_arrays: usersID })
                }).then(res => {
                    location.reload(true);
                })

            } else if(actionSelected == 'UPDATE'){
                var data = [];

                usersID.forEach(userID => {
                    var form =  document.querySelector(`#updateUser${userID}`);
                    data.push({id: userID, level: +form.querySelector('select').value});
                })

                console.log(data)

                fetch('http://localhost:8000/api/users/multiple-update',{
                    method: 'post',
                    headers:{
                        'Content-Type': 'application/json',
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ 'updates': data })
                }).then(res => {
                    location.reload(true);
                })
    
                // console.log(formsSelected);
            }

           


            // console.log(usersID);
            
            // location.reload(true);
        };


        


    },
}



app.run();

