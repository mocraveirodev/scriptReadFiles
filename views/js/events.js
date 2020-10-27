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