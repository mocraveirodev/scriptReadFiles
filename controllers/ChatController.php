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
            case "token":
                $this->viewToken();
            break;
            case "api":
                $this->uploadAPI();
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

    private function viewMeta(){
        $_SESSION['folder'] = 'chat';
        $_SESSION['page'] = 'meta';
        $this->viewLayout();
    }
    
    private function viewToken(){
        $_SESSION['folder'] = 'chat';
        $_SESSION['page'] = 'token';
        $this->viewLayout();
    }

    private function viewAPI(){
        $_SESSION['folder'] = 'chat';
        $_SESSION['page'] = 'api';
        $this->viewLayout();
    }
    
    private function readMeta(){
        $path = $_POST['path-meta'] . "/";
        $file = $_POST['file-meta'];

        $reader = IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load($path.$file);
        $sheet = $spreadsheet->getActiveSheet();

        $linhas = [];

        foreach ($sheet->getRowIterator(6) as $row) {
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
        $chats = [];

        while($arquivo = $diretorio -> read()){
            if(strlen($arquivo) > 3){
                if(array_key_exists($arquivo, $_SESSION['metadata'])){
                    $data = $_SESSION['metadata'][$arquivo];
                    $file = $this->getChatData(file_get_contents($path.$arquivo));

                    $metadata = "{
    \"Metadata\": [
        {
            \"Key\": \"ClientCaptureDate\",
            \"Value\": \"{$file['data']}\"
        },
        {
            \"Key\": \"ClientID\",
            \"Value\": \"{$data['ClientID']}\"
        },
        {
            \"Key\": \"AudioFileLocation\",
            \"Value\": \"{$arquivo}\"
        },
        {
            \"Key\": \"Agent\",
            \"Value\": \"{$data['Agent']}\"
        },
        {
            \"Key\": \"UDF_text_01\",
            \"Value\": \"{$data['UDF_text_01']}\"
        },
        {
            \"Key\": \"ANI\",
            \"Value\": \"{$data['ANI']}\"
        },
        {
            \"Key\": \"ExitStatus\",
            \"Value\": \"{$data['ExitStatus']}\"
        },
        {
            \"Key\": \"Dept\",
            \"Value\": \"{$data['Dept']}\"
        },
        {
            \"Key\": \"UDF_text_02\",
            \"Value\": \"{$data['UDF_text_02']}\"
        },
        {
            \"Key\": \"TransferTo\",
            \"Value\": \"{$data['TransferTo']}\"
        },
        {
            \"Key\": \"TransferFrom\",
            \"Value\": \"{$data['TransferFrom']}\"
        },
        {
            \"Key\": \"ContentGroup\",
            \"Value\": \"{$data['ContentGroup']}\"
        },
        {
            \"Key\": \"WaitTimeSeconds\",
            \"Value\": \"{$data['WaitTimeSeconds']}\"
        },
        {
            \"Key\": \"AgentGroup\",
            \"Value\": \"{$data['AgentGroup']}\"
        },
        {
            \"Key\": \"UDF_text_03\",
            \"Value\": \"{$data['UDF_text_03']}\"
        }
    ],
    \"MediaType\": \"Chat\",
    \"ClientCaptureDate\": \"{$file['dataISO']}\",
    \"SourceId\": \"Five9\",
    \"CorrelationId\": \"{$data['ClientID']}\",
    \"Transcript\": [".$file['text'];

                    $chats[$data['ClientID']] = $metadata;
                }
            }
        }

        $diretorio -> close();

        $_SESSION['chats'] = $chats;
        
        $this->viewMeta();
    }

    private function getChatData($chat){
        $client = trim(between('<b>Omni.name:</b> ', '<br/>', $chat));
        $chat = str_replace(after_last('<br/>', $chat), '', $chat);
        $chat = str_replace(before('<b>Omni.question:</b> Olá.<br/>', $chat), '', $chat);
        $chat = str_replace("<b>Omni.question:</b> Olá.<br/>\r\n<br/>\r\n", '', $chat);
        $chat = substr($chat, 0, (strripos($chat, '<br/>') - strlen($chat)));
        $data = date('Y-m-d H:i:s', strtotime(before(' <i>', $chat)));        
        $dataISO = date(DateTime::ISO8601, strtotime($data));
        $chat = explode("<br/>\r\n", $chat);
        $text = '';

        foreach ($chat as $key => $value) {
            $speaker = trim(between("<i>", ":</i>", $value));
            $texto = str_replace("\"","'", trim(after_last("</i>", $value)));
            $dataChat = date('Y-m-d H:i:s', strtotime(before(' <i>', $value)));        
            $dataChatISO = date(DateTime::ISO8601, strtotime($data));
            if($client == $speaker){
                $text .="
        {
            \"Speaker\": 2,
            \"Text\": \"$texto\",
            \"PostDateTime\": \"$dataChatISO\",
            \"TextInformation\": \"$speaker\"
        },";
            }else{
                $text .="
        {
            \"Speaker\": 1,
            \"Text\": \"$texto\",
            \"PostDateTime\": \"$dataChatISO\",
            \"TextInformation\": \"$speaker\"
        },";
            }
        }

        $text = before_last(",", $text);
        $endData = "
    ]
}";
        $text .= $endData;

        return ['data' => $data, 'dataISO' => $dataISO, 'text' => $text];
    }
    private function uploadAPI(){
        $erro = [];
        $resultado = [];

        foreach($_SESSION['chats'] as $id => $string){
            $_SESSION['token'] = $_POST['token'];
            $resposta = $this->callAPI($_POST['token'], $string);

            if(is_null($resposta)){
                $erro[$id] = $string;
            }else{
                $resultado[$id] = $resposta;
            }
        }

        if($erro){
            foreach($erro as $id => $string){
                $resposta = $this->callAPI($_POST['token'], $string);
                array_shift($erro);
    
                if(is_null($resposta)){
                    $erro[$id] = $string;
                }else{
                    $resultado[$id] = $resposta;
                }
            }
        }

        $_SESSION['erro'] = $erro;
        $_SESSION['resultado'] = $resultado;

        $this->viewAPI();
    }

    private function callAPI($token, $string){
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',                    
                'header' => "Authorization: JWT $token\r\n"."Content-type: application/json; charset=utf-8\r\n",
                'content' => $string                            
            )
        ));

        $contents = @file_get_contents("https://ingestion.callminer.net/api/transcript", null, $context);

        if(strpos($http_response_header[0], "200")) { 
            $resposta = json_decode($contents, true);
            
            return $resposta;
        } else { 
            return null;
        }
    }
}