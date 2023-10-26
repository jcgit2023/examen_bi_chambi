<?php
session_start();
require_once("../../conexion.php");

$__id_precio =$_REQUEST["id_precio"];
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$db->debug=true;

/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_PERSONA ESTA CON HERENCIA*/
$sql = $db->Prepare("SELECT *
                    FROM detalles_compras
                    WHERE id_precio = ?
                    AND estado<>'X'
                    ");
$rs = $db->GetAll($sql, array($__id_precio));

$sq2 = $db->Prepare("SELECT *
                    FROM detalles_ventas
                    WHERE id_precio = ?
                    AND estado<>'X'
                    ");
$rs2 = $db->GetAll($sq2, array($__id_precio));

if (!$rs and !$rs2) {
    $reg = array();
    $reg["estado"]='X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs3 = $db->AutoExecute("precios", $reg, "UPDATE", "id_precio='".$__id_precio."'"); 
    header("Location: precios.php");
    exit();
}else {
    echo"<div class='mensaje'>";
 $mensage = "NO SE ELIMINARON LOS DATOS DEL PRECIO POR QUE TIENE HERENCIA";
 echo"<h1>".$mensage."</h1>";
 
 echo"<a href='precios.php'>
           <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
      </a>     
     ";
echo"</div>" ;
}

echo "</body>
</html> ";
?> 