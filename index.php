<?php
    $rotas = key($_GET)?key($_GET):"home";

    switch($rotas){
        case "home":
            include "controllers/MakeController.php";
            $controller = new MakeController();
            $controller->acao($rotas);
        break;

        case "path":
            include "controllers/MakeController.php";
            $controller = new MakeController();
            $controller->acao($rotas);
        break;
    }
?>