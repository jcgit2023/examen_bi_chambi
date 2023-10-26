<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       
$tipo_producto = $_POST["tipo_producto"];

if(($tipo_producto!="")){
   $reg = array();
   $reg["tipo_producto"] = $tipo_producto;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];
   $reg["estado"] = 'A';
      
   $rs1 = $db->AutoExecute("tipo_productos", $reg, "INSERT"); 
   header("Location: tipo_productos.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL TIPO DE PRODUCTO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='tipo_producto_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 