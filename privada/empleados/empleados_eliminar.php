<?php
session_start();
require_once("../../conexion.php");

$__id_empleado =$_REQUEST["id_empleado"];
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$db->debug=true;

/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_PERSONA ESTA CON HERENCIA*/
$sql = $db->Prepare("SELECT *
                    FROM ventas
                    WHERE id_empleado = ?
                    AND estado<>'X'
                    ");
$rs = $db->GetAll($sql, array($__id_empleado));

if (!$rs) {
    $reg = array();
    $reg["estado"]='X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("empleados", $reg, "UPDATE", "id_empleado='".$__id_empleado."'"); 
    header("Location: empleados.php");
    exit();
}else {
  require_once("../../libreria_menu.php");
    echo"<div class='mensaje'>";
 $mensage = "NO SE ELIMINARON LOS DATOS DEL EMPLEADO POR QUE TIENE HERENCIA";
 echo"<h1>".$mensage."</h1>";
 
 echo"<a href='empleados.php'>
           <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
      </a>     
     ";
echo"</div>" ;
}

echo "</body>
</html> ";
?> 