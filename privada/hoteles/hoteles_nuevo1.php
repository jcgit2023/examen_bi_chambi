<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$id_cadena_agencia_viaje = $_POST["id_cadena_agencia_viaje"];
$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$telefonos = $_POST["telefonos"];
$nro_plazas_disponibles = $_POST["nro_plazas_disponibles"];
$ciudad = $_POST["ciudad"];
$direccion = $_POST["direccion"];

if(($id_cadena_agencia_viaje!="") and  ($codigo!="") and ($nombre!="") and ($telefonos!="")){
   $reg = array();
   $reg["id_cadena_agencia_viaje"] = $id_cadena_agencia_viaje;
   $reg["codigo"] = $codigo;
   $reg["nombre"] = $nombre;
   $reg["telefonos"] = $telefonos;
   $reg["nro_plazas_disponibles"] = $nro_plazas_disponibles;
   $reg["ciudad"] = $ciudad;
   $reg["direccion"] = $direccion;
     
   $rs1 = $db->AutoExecute("hoteles", $reg, "INSERT"); 
   header("Location: hoteles.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL HOTEL";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='hoteles_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 