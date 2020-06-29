<?php
/*
*Criado por Rafael Fernandes
*Bot para encurtar links utilizando a api do Yourls
*mude o nome do arquivo para getUpdates.php
*/
include "Telegram.php";
include "encurtador.php";

$telegram = new Telegram('810079691:AAE2HKCdvRBeAI3ep3P-rQRm7C4cCf8JkNA');
$api_key="613296ea4d";
$texto = $telegram->Text();
$chat_id = $telegram->ChatID();


if($texto == "/start") {
    $option = [['Sobre', 'Comandos']];
    // Create a permanent custom keyboard
    $keyb = $telegram->buildKeyBoard($option, $onetime = false);

$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => 'Bem vindo! Esse bot foi feito para encurtar links, utilizando a api do YOURLS. \n Esse bot não é oficial.');
$telegram->sendMessage($content);
}

if($texto == "/sobre" || $texto == "Sobre") {
$content =array('chat_id' => $chat_id, 'text' => 'Criado por Rafael Fernandes, @acessibilisando
Hospedagem: https://dgicloud.com.br/
Biblioteca usada: https://gitlab.poravinternet.ru/max0015/TelegramBotPHP');
$telegram->sendMessage($content);
}

if($texto == "Comandos") {
$content =array('chat_id' => $chat_id, 'text' => '/encurtar <link>: Encurta o link, atenção, coloque espaço entre o comando e o link. /start: Inicia o bot. /del <link curto>: deleta o link do banco de dados, atenção, coloque espaço entre o comando e o link.');
$telegram->sendMessage($content);
}

//encurtar link no banco de dados
$parte = substr($texto, 0, 10);
if($parte == "/encurtar ") {
$encurtando=encurtarLink($texto, $api_key);

$content =array('chat_id' => $chat_id, 'text' => $encurtando);
$telegram->sendMessage($content);
}

//Deletar link do banco de dados
$parted = substr($texto, 0, 5);
if($parted == "/del ") {
$encurtando=deletLink($texto, $api_key);

$content =array('chat_id' => $chat_id, 'text' => $encurtando);
$telegram->sendMessage($content);
}

/*Se o usuário mandar /encurtarh, ou /encurtarw*/
if($parte == "/encurtarh" || $parte == "/encurtarw") {
$content =array('chat_id' => $chat_id, 'text' => 'Atenção, coloque espaço antes da url!');
$telegram->sendMessage($content);
}
