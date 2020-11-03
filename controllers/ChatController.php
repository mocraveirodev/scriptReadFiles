<?php

session_start();

require 'vendor/autoload.php';

include_once('views/includes/substrfunctions.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Sao_Paulo');

class ChatController{
    public function acao($rotas){
        switch($rotas){
            case "data":
                $this->viewData();
            break;
            case "meta":
                $this->readMeta();
            break;
            case "chat":
                $this->viewChat();
            break;
            case "path":
                $this->readChat();
            break;
        }
    }

    private function viewLayout(){
        include "views/layout.php";
    }

    private function viewData(){
        $_SESSION['folder'] = 'chat';
        $_SESSION['page'] = 'data';
        $this->viewLayout();
    }

    private function viewChat(){
        $_SESSION['folder'] = 'chat';
        $_SESSION['page'] = 'chat';
        $this->viewLayout();
    }
    
    private function readMeta(){
        $path = $_POST['path-meta'] . "/";
        $file = $_POST['file-meta'];

        $reader = IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load($path.$file);
        $sheet = $spreadsheet->getActiveSheet();

        $linhas = [];

        foreach ($sheet->getRowIterator(8) as $row) {
            $cellInterator = $row->getCellIterator();
            $cellInterator->setIterateOnlyExistingCells(false);
            $linha = [];

            foreach ($cellInterator as $cell) {
                if(!is_null($cell)){
                    $value = $cell->getCalculatedValue();

                    array_push($linha, $value);
                }
            }

            if(is_null($linha[7])){
                continue;
            }

            $linhas[$linha[7] . ".html"] = [
                'Agent' => $linha[4],
                'ClientID' => $linha[7],
                'UDF_text_01' => $linha[5],
                'ANI' => $linha[0],
                'ExitStatus' => $linha[8],
                'Dept' => $linha[9],
                'UDF_text_02' => $linha[10],
                'TransferTo' => $linha[11],
                'TransferFrom' => $linha[12],
                'ContentGroup' => $linha[13],
                'WaitTimeSeconds' => $linha[14],
                'AgentGroup' => $linha[19],
                'UDF_text_03' => $linha[20]
            ];
        }

        $_SESSION['metadata'] = $linhas;
        
        echo "<script>window.location.href = '/mm/?chat';</script>";
    }

    private function readChat(){
        $path = $_POST['path'] . "/";
        $diretorio = dir($path);
        $cont = 1;

        while($arquivo = $diretorio -> read()){
            if(strlen($arquivo) > 3){
                if(array_key_exists($arquivo, $_SESSION['metadata'])){
                    $file = file($path.$arquivo);
                    $metadata = $_SESSION['metadata'][$arquivo];
                    $data = date('Y-m-d H:i:s', strtotime(before(" <i>", $file[15])));
                    $dataISO = date(DateTime::ISO8601, strtotime($data));
                    echo $data . "<br>";

                    $metadata = "{
    \"Metadata\": [
        {
            \"Key\": \"ClientCaptureDate\",
            \"Value\": \"$data\"
        },
        {
            \"Key\": \"ClientID\",
            \"Value\": \"{$metadata['ClientID']}\"
        },
        {
            \"Key\": \"AudioFileLocation\",
            \"Value\": \"{$arquivo}\"
        },
        {
            \"Key\": \"Agent\",
            \"Value\": \"{$metadata['Agent']}\"
        },
        {
            \"Key\": \"UDF_text_01\",
            \"Value\": \"{$metadata['UDF_text_01']}\"
        },
        {
            \"Key\": \"ANI\",
            \"Value\": \"{$metadata['ANI']}\"
        },
        {
            \"Key\": \"ExitStatus\",
            \"Value\": \"{$metadata['ExitStatus']}\"
        },
        {
            \"Key\": \"Dept\",
            \"Value\": \"{$metadata['Dept']}\"
        },
        {
            \"Key\": \"UDF_text_02\",
            \"Value\": \"{$metadata['UDF_text_02']}\"
        },
        {
            \"Key\": \"TransferTo\",
            \"Value\": \"{$metadata['TransferTo']}\"
        },
        {
            \"Key\": \"TransferFrom\",
            \"Value\": \"{$metadata['TransferFrom']}\"
        },
        {
            \"Key\": \"ContentGroup\",
            \"Value\": \"{$metadata['ContentGroup']}\"
        },
        {
            \"Key\": \"WaitTimeSeconds\",
            \"Value\": \"{$metadata['WaitTimeSeconds']}\"
        },
        {
            \"Key\": \"AgentGroup\",
            \"Value\": \"{$metadata['AgentGroup']}\"
        },
        {
            \"Key\": \"UDF_text_03\",
            \"Value\": \"{$metadata['UDF_text_03']}\"
        }
    ],
    \"MediaType\": \"Chat\",
    \"ClientCaptureDate\": \"{$dataISO}\",
    \"SourceId\": \"mex-madeiramadeira\",
    \"CorrelationId\": \"{$metadata['ClientID']}\",
    \"Transcript\": [";
                }

                $cont++;
            }
        }

        $diretorio -> close();
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