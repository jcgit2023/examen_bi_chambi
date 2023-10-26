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
$tipo_producto = $_POST["tipo_producto"];




if(($tipo_producto!="")){
   $reg = array();
   $reg["tipo_producto"] = $tipo_producto;   
 
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("tipo_productos", $reg, "UPDATE", "id_tipo_producto='".$id_tipo_producto."'"); 
   header("Location: tipo_productos.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DEL CLIENTE";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='tipo_productos.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 