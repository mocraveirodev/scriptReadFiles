<?php

function viewPath(){
    $path = str_replace("\\", "/", $_POST['path']);
    $chats = $this->getDataChat($path."/");
    $_SESSION['chats'] = $chats;
    var_dump($chats);
}

function getDataChat($path){
    $diretorio = dir($path);
    $chats = [];
    $cont = 0;

    while($arquivo = $diretorio -> read()){
        if(strlen($arquivo) > 3){
            $cont++;
            $chat = file_get_contents($path.$arquivo);

            makeMetadata($chat);
            array_push($chats,$chat);
        }
    }

    return $chats;
}