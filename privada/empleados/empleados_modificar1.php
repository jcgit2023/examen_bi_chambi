<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$id_tienda = $_POST["id_tienda"];
$id_empleado = $_POST["id_empleado"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$turno = $_POST["turno"];
$ci = $_POST["ci"];

if(($id_tienda!="") and  ($nombre!="") and ($turno!="")){
    $reg = array();
    $reg["id_tienda"] = $id_tienda;
    $reg["nombre"] = $nombre;
    $reg["apellido"] = $apellido;
    $reg["turno"] = $turno;
    $reg["ci"] = $ci;
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
    $rs1 = $db->AutoExecute("empleados", $reg, "UPDATE", "id_empleado='" .$id_empleado."'"); 
    header("Location: empleados.php");
    exit();
 } else {
            echo"<div class='mensaje'>";
         $mensage = "NO SE MODIFICARON LOS DATOS DEL EMPLEADO";
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