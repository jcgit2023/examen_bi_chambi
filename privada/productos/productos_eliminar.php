<?php
session_start();
require_once("../../conexion.php");

$__id_producto = $_REQUEST["id_producto"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
//$db->debug=true;

/*las consultas se tienen que hacer con todas las tablas en las que id_persona esta como herencia */
$sql = $db->Prepare("SELECT *
                    FROM almacen
                    WHERE id_producto = ? 
                    AND estado <>'X'                       
                        ");
$rs1 = $db->GetAll($sql, array($__id_producto));

$sq2 = $db->Prepare("SELECT *
                    FROM precios
                    WHERE id_producto = ? 
                    AND estado <>'X'                       
                        ");
$rs2 = $db->GetAll($sq2, array($__id_producto));


if(!$rs1 and !$rs2){
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
    $rs3 = $db->AutoExecute("productos", $reg, "UPDATE", "id_producto='".$__id_producto."'"); 
    header("Location: productos.php");
    exit();

 } else {
  require_once("../../libreria_menu.php");
            echo"<div class='mensaje'>";
         $mensage = "NO SE ELIMINARON LOS DATOS DEL PRODUCTO PORQUE TIENE HERENCIA";
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
 