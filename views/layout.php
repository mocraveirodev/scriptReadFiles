<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Somos a MEX Consulting, uma consultoria de incremento de resultados e qualidade, que atua com metodologia adaptada às necessidades dos clientes, ancorada à consagrada plataforma de speech analytics Eureka, da empresa americana CallMiner, que possibilita a captura em larga escala da voz dos consumidores (voice of customers) e dos agentes">
    <meta name="keywords" content="Incremento de Performance,Melhora de Qualidade,Auditoria de Processos,Redução de Custos,Satisfação dos Clientes,Analytics,Speech Analytics,Qualidade,Auditoria,Processo,Processos,ROI">
    <meta name="author" content="Monica Craveiro">
    <title>Mex Consulting - Madeira Madeira</title>
    <!-- FAVICON -->
    <link rel="shortcut icon" href="views/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="views/img/favicon.ico" type="image/x-icon">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- CSS PERSONALIZADO -->
    <link rel="stylesheet" href="views/css/style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="#">
                <img src="views/img/Logo_Mex_Branco.png" class="d-inline-block align-top logo" alt="Logo Mex Consulting" loading="lazy">
            </a>
        </nav>
    </header>
    <main class="">
        <div class="container">
            <div class="card w-50 mt-5 mx-auto">
                <div class="card-header">
                    <h5 class="text-white text-center font-weight-bold">Madeira Madeira</h5>
                </div>
                <div class="card-body">
                    <?php if($_SESSION['page'] == 'home'): ?>
                        <h5 class="mb-4">Informe o tipo de Ingestão: </h5>
                        <a href="/mm/?audio" class="btn btn-mex">Áudio</a>
                        <a href="/mm/?data" class="btn btn-mex">Chat</a>
                    <?php
                        else:
                            include "views/includes/" . $_SESSION['folder'] . "/" . $_SESSION['page'] . ".php";
                        endif;

                        unset($_SESSION['folder']);
                        unset($_SESSION['page']);
                    ?>
                </div>
            </div>
        </div>
    </main>
    
    <!-- SCRIPTS BOOTSTRAP -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <?php unset($_SESSION); ?>
</body>
</html>