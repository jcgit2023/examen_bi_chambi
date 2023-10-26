<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$__id_cliente =$_REQUEST["id_cliente"];
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
//$db->debug=true;

/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_PERSONA ESTA CON HERENCIA*/
$sql = $db->Prepare("SELECT *
                    FROM ventas
                    WHERE id_cliente = ?
                    AND estado<>'X'
                    ");
$rs = $db->GetAll($sql, array($__id_cliente));

if (!$rs) {
    $reg = array();
    $reg["estado"]='X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("clientes", $reg, "UPDATE", "id_cliente='".$__id_cliente."'"); 
    header("Location: clientes.php");
    exit();
}else {
    echo"<div class='mensaje'>";
 $mensage = "NO SE ELIMINARON LOS DATOS DEL CLIENTE POR QUE TIENE HERENCIA";
 echo"<h1>".$mensage."</h1>";
 
 echo"<a href='clientes.php'>
           <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
      </a>     
     ";
echo"</div>" ;
}

echo "</body>
</html> ";
?> 