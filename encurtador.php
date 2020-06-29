<?php

//função que encurta a URL
function encurtarLink($urlg, $key) {
$encurtando= $urlg;
$tratado = substr($encurtando, 10);

$url = ("http://acessibilizando.tech/encurtador/yourls-api.php?signature=$key&action=shorturl&url=$tratado&format=json");

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result=curl_exec($ch);
curl_close($ch);

//faz o parsing na string, gerando um objeto PHP
$obj = json_decode($result);

if($obj->status == "fail") {

return "essa url ja se encontra em nosso banco de dados: $obj->shorturl";
}
return "URL encurtada: $obj->shorturl";
}

//Essa função fas o reverço da anterior, deleta do banco de dados.
function deletLink($urlg, $key) {
$encurtando= $urlg;
$tratado = substr($encurtando, 5);

$url = ("http://acessibilizando.tech/encurtador/yourls-api.php?signature=$key&action=delete&shorturl=$tratado&format=json");

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result=curl_exec($ch);
curl_close($ch);

//faz o parsing na string, gerando um objeto PHP
$obj = json_decode($result);

if($obj->message == "error: not found") {

return "Atenção, essa URL ja foi apagada do banco de dados, ou está incorreta. Verifique se digitou corretamente.";
}
return "URL deletada do banco de dados.";
}

?>