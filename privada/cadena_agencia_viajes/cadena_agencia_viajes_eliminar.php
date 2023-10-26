<?php
session_start();
require_once("../../conexion.php");

$__id_cadena_agencia_viaje =$_REQUEST["id_cadena_agencia_viaje"];
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$db->debug=true;

/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_PERSONA ESTA CON HERENCIA*/
$sql = $db->Prepare("SELECT *
                    FROM hoteles
                    WHERE id_cadena_agencia_viaje = ?
                    AND nombre <> ''
                    ");
$rs = $db->GetAll($sql, array($__id_cadena_agencia_viaje));

$sql2 = $db->Prepare("SELECT *
                    FROM personas
                    WHERE id_cadena_agencia_viaje = ?
                    AND nombres <> ''
                    ");
$rs2 = $db->GetAll($sql2, array($__id_cadena_agencia_viaje));


if (!$rs and !$rs2) {
    $rs = $db->Execute("DELETE FROM cadena_agencia_viajes WHERE id_cadena_agencia_viaje=$__id_cadena_agencia_viaje");
    header("Location: cadena_agencia_viajes.php");
    exit();
}else {
  require_once("../../libreria_menu.php");
    echo"<div class='mensaje'>";
 $mensage = "NO SE ELIMINARON LOS DATOS DE LA CADENA AGENCIA VIAJE POR QUE TIENE HERENCIA";
 echo"<h1>".$mensage."</h1>";
 
 echo"<a href='cadena_agencia_viajes.php'>
           <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
      </a>     
     ";
echo"</div>" ;
}

echo "</body>
</html> ";
?> 