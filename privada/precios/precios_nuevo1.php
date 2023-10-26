<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$id_producto = $_POST["id_producto"];
$precio = $_POST["precio"];
$fec_asignacion = $_POST["fec_asignacion"];


if(($id_producto!="") and($fec_asignacion!="") and ($precio!="")){
   $reg = array();
   $reg["id_tienda"] = 1;
   $reg["id_producto"] = $id_producto;
   $reg["precio"] = $precio;
   $reg["fec_asignacion"] = $fec_asignacion;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["usuario"] = $_SESSION["sesion_id_usuario"]; 
   $reg["estado"] = 'A';
   $rs1 = $db->AutoExecute("precios", $reg, "INSERT"); 
   header("Location: precios.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL NUEVO PRECIO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='precios_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 