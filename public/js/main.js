let chooingImg = document.getElementById("output");

var ChangeFilter = function(value){
    if(value == 1){
        chooingImg.className = 'filter1 @php($filter=class="filter1")';
    }
    else if(value == 2){
     chooingImg.className = 'filter2';
    }
    else if(value == 3){
     chooingImg.className = 'filter3';
    }
    else if(value == 4){
     chooingImg.className = 'filter4';
    }
    else if(value == 5){
     chooingImg.className = 'filter5';
    }
    else{
     chooingImg.className = 'original';
    }
}


var loadFile = function(event) {
 var output = document.getElementById('output');
 output.src = URL.createObjectURL(event.target.files[0]);
 output.onload = function() {
   URL.revokeObjectURL(output.src) // free memory
 }
};
