<?php
session_start();
require_once("../../conexion.php");


$__id_hotel =$_REQUEST["id_hotel"];
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$db->debug=true;

$rs = $db->Execute("DELETE FROM hoteles WHERE id_hotel=$__id_hotel");
header("Location: hoteles.php");

echo "</body>
</html> ";
?> 