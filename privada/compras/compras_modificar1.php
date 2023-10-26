<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$id_proveedor = $_POST["id_proveedor"];
$id_compra = $_POST["id_compra"];
$monto = $_POST["monto"];
$fec_compra = $_POST["fec_compra"];

if(($id_proveedor!="") and  ($monto!="")){
    $reg = array();
    $reg["id_proveedor"] = $id_proveedor;
    $reg["monto"] = $monto;
    $reg["fec_compra"] = $fec_compra;
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
    $rs1 = $db->AutoExecute("compras", $reg, "UPDATE", "id_compra='" .$id_compra."'"); 
    header("Location: compras.php");
    exit();
 } else {
            echo"<div class='mensaje'>";
         $mensage = "NO SE MODIFICARON LOS DATOS DE LA COMPRA";
         echo"<h1>".$mensage."</h1>";
         
         echo"<a href='compras.php'>
                   <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
              </a>     
             ";
        echo"</div>" ;
    }
 
 
 echo "</body>
       </html> ";
 ?> 