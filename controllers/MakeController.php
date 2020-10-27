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
        var_dump($_POST);
    }
}