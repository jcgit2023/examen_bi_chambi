<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       
$nombre = $_POST["nombre"];
$telefonos = $_POST["telefonos"];
$pag_web = $_POST["pag_web"];


if(($nombre!="") and  ($telefonos!="") and ($pag_web!="")){
   $reg = array();
   $reg["nombre"] = $nombre;
   $reg["telefonos"] = $telefonos;
   $reg["pag_web"] = $pag_web;
   $rs1 = $db->AutoExecute("cadena_agencia_viajes", $reg, "INSERT"); 
   header("Location: cadena_agencia_viajes.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA PERSONA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='cadena_agencia_viajes_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 