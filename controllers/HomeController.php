<?php

session_start();

set_time_limit(100000);

class HomeController{
    public function acao($rotas){
        switch($rotas){
            case "home":
                $this->viewHome();
            break;
        }
    }

    private function viewHome(){
        $_SESSION['page'] = 'home';
        include "views/layout.php";
    }
}





// recordings/recording/Data_hora	ClientCaptureDate
// recordings/recording/Id_do_chat	ClientID
// recordings/recording/Nome_do_Audio	AudioFileLocation
// recordings/recording/NOME_DO_AGENTE	Agent
// recordings/recording/USUARIO	UDF_text_01
// recordings/recording/ID_do_cliente	ANI
// recordings/recording/STATUS	ExitStatus
// recordings/recording/CAMPANHA	Dept
// recordings/recording/NOME_CLIENTE	UDF_text_02
// recordings/recording/TRANSFERIDA_PARA	TransferTo
// recordings/recording/TRANSFERIDO_DE	TransferFrom
// recordings/recording/GRUPO_DO_USUARIO	ContentGroup
// recordings/recording/TEMPO_EM_FILA	WaitTimeSeconds
// recordings/recording/GRUPO_DE_AGENTES	AgentGroup
// recordings/recording/ID_Agente	UDF_text_03