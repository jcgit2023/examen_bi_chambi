<?php
session_start();
require_once("../../conexion.php");

$__id_tipo_producto =$_REQUEST["id_tipo_producto"];
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$db->debug=true;

/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_PERSONA ESTA CON HERENCIA*/
$sql = $db->Prepare("SELECT *
                    FROM productos
                    WHERE id_tipo_producto = ?
                    AND estado<>'X'
                    ");
$rs = $db->GetAll($sql, array($__id_tipo_producto));

if (!$rs) {
    $reg = array();
    $reg["estado"]='X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("tipo_productos", $reg, "UPDATE", "id_tipo_producto='".$__id_tipo_producto."'"); 
    header("Location: tipo_productos.php");
    exit();
}else {
    echo"<div class='mensaje'>";
 $mensage = "NO SE ELIMINARON LOS DATOS DEL USUARIO POR QUE TIENE HERENCIA";
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