<?php

class MakeController{
    public function acao($rotas){
        switch($rotas){
            case "home":
                $this->viewHome();
            break;
            case "path":
                $this->viewPath();
            break;
        }
    }

    private function viewHome(){
        include "views/home.php";
    }

    private function viewPath(){
        $path = str_replace("\\", "/", $_POST['path']);
        $chats = $this->getDataChat($path."/");
        $_SESSION['chats'] = $chats;
        
        
    }

    function getDataChat($path){
        $diretorio = dir($path);
        $chats = [];
        $cont = 0;

        while($arquivo = $diretorio -> read()){
            if(strlen($arquivo) > 3){
                $cont++;
                $chat = file_get_contents($path.$arquivo);
                array_push($chats,$chat);
            }
        }

        return $chats;
    }
}