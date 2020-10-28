function getDataChat(path){
    console.log(path);
    $.ajax({
        url: window.location.href + 'path',
        type: 'POST',
        dataType: 'json',
        data: path,
        success: function(result){
            // console.log(result);
        },
        error: function(xhr){
            console.log(xhr);
        }
    });
}