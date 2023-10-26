<?php

/*llama a una libreria, si esta abierta la ejecuta y si esta cerrada la abre*/
require_once("adodb/adodb.inc.php"); 


$conServidor = "localhost";
$conUsuario = "root";
$conClave = "";
$conBasededatos = "proyecto";

$db = ADONewConnection("mysqli");

//$db-> debug = true;

$conex = $db->Connect($conServidor, $conUsuario, $conClave, $conBasededatos);
$db->Execute("SET NAMES 'utf8'");
?>