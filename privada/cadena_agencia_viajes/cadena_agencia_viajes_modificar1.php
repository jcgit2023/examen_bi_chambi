<?php
session_start();
require_once("../../conexion.php");

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$id_cadena_agencia_viaje=$_POST["id_cadena_agencia_viaje"];
$nombre = $_POST["nombre"];
$telefonos = $_POST["telefonos"];
$pag_web = $_POST["pag_web"];

if(($nombre!="") and  ($telefonos!="")){
    $reg = array();
    $reg["nombre"] = $nombre;
    $reg["telefonos"] = $telefonos;
    $reg["pag_web"] = $pag_web;

    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("cadena_agencia_viajes", $reg, "UPDATE", "id_cadena_agencia_viaje='".$id_cadena_agencia_viaje."'"); 
    header("Location: cadena_agencia_viajes.php");
    exit();
 } else {
            echo"<div class='mensaje'>";
         $mensage = "NO SE MODIFICARON LOS DATOS DE LA CADENA AGENCIA VIAJE";
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