import 'bootstrap'


var app = { 
    run : function(){
        app.runOrderTable;
    },

    runOrderTable: function(){
        var orderTable = document.querySelector('.cart-table');

        if(orderTable){
            $addBtnElements = document.querySelectorAll('.add-button');
            $subBtnElements = document.querySelectorAll('.sub-button');
            $nextToBtn = document.querySelector('#nextToBtn');
            $updateBtn = document.querySelector('#updateCart');

            $addBtnElements.forEach(btn => {
                btn.onclick = function() {
                    var inputSelected = document.querySelector(`[data-id="${this.dataset.btnTarget}"]`);
                    if( inputSelected.value <  10){
                    inputSelected.value ++;
                    }
                    nextToBtn.style.pointerEvents = 'none';
                    nextToBtn.classList.add('disabled');
                }
            });

            $subBtnElements.forEach(btn => {
                btn.onclick = function() {
                    var inputSelected = document.querySelector(`[data-id="${this.dataset.btnTarget}"]`);
                    if( inputSelected.value > 0){
                    inputSelected.value --;
                    }
                    
                    nextToBtn.style.pointerEvents = 'none';
                    nextToBtn.classList.add('disabled');
                }
                
            });
        }
    }
}



app.run();


