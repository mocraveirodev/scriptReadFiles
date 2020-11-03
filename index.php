<?php
    $rotas = key($_GET)?key($_GET):"home";

    switch($rotas){
        case "home":
            include "controllers/HomeController.php";
            $controller = new HomeController();
            $controller->acao($rotas);
        break;
        case "audio":
            include "controllers/AudioController.php";
            $controller = new AudioController();
            $controller->acao($rotas);
        break;
        case "data":
            include "controllers/ChatController.php";
            $controller = new ChatController();
            $controller->acao($rotas);
        break;
        case "meta":
            include "controllers/ChatController.php";
            $controller = new ChatController();
            $controller->acao($rotas);
        break;
        case "chat":
            include "controllers/ChatController.php";
            $controller = new ChatController();
            $controller->acao($rotas);
        break;
        case "path":
            include "controllers/ChatController.php";
            $controller = new ChatController();
            $controller->acao($rotas);
        break;
    }
?>