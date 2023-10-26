<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$id_tipo_producto = $_POST["id_tipo_producto"];
$id_producto = $_POST["id_producto"];
$nombre = $_POST["nombre"];
$fec_venc = $_POST["fec_venc"];

if(($id_tipo_producto!="") and  ($nombre!="")){
    $reg = array();
    $reg["id_tipo_producto"] = $id_tipo_producto;
    $reg["nombre"] = $nombre;
    $reg["fec_venc"] = $fec_venc;
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
    $rs1 = $db->AutoExecute("productos", $reg, "UPDATE", "id_producto='" .$id_producto."'"); 
    header("Location: productos.php");
    exit();
 } else {
            echo"<div class='mensaje'>";
         $mensage = "NO SE MODIFICARON LOS DATOS DE LA COMPRA";
         echo"<h1>".$mensage."</h1>";
         
         echo"<a href='productos.php'>
                   <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
              </a>     
             ";
        echo"</div>" ;
    }
 
 
 echo "</body>
       </html> ";
 ?> 