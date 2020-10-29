function getDataChat(path){
    $.ajax({
        url: 'views/functions/readChat.php',
        type: 'POST',
        dataType: 'json',
        data: path,
        success: function(result){
            uploadApi(result);
        },
        error: function(xhr){
            console.log(xhr);
        }
    });
}