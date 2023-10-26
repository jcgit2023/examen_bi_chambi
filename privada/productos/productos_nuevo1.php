<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$id_tipo_producto = $_POST["id_tipo_producto"];
$nombre = $_POST["nombre"];
$fec_venc = $_POST["fec_venc"];


if(($id_tipo_producto!="") and($fec_venc!="") and ($nombre!="")){
   $reg = array();
   $reg["id_tienda"] = 1;
   $reg["id_tipo_producto"] = $id_tipo_producto;
   $reg["fec_venc"] = $fec_venc;
   $reg["nombre"] = $nombre;
   $reg["foto"] = "";
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["usuario"] = $_SESSION["sesion_id_usuario"]; 
   $reg["estado"] = 'A';
   $rs1 = $db->AutoExecute("productos", $reg, "INSERT"); 
   header("Location: productos.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL NUEVO PRODUCTO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='productos_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 