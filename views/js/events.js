$(document).ready(function(){ 
    fillChoose();    
});

$(document).on('click', '#btnAudio', function(e){
    e.preventDefault();

});

$(document).on('click', '#btnChat', function(e){
    e.preventDefault();
    fillFormChat();
});

$(document).on('submit', '#path', function(e){
    e.preventDefault();
    getDataChat({
        'path': $('#pathChat').val()
    });
});

// console.log(window.location);