<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='tipo_producto_nuevo.php'>Nuevo Tipo Producto</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' 
       value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;
       ' class='boton_cerrar'></a>";
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
       echo"<h1>LISTADO DE TIPO PRODUCTOS</h1>";

$sql = $db->Prepare("SELECT *
                     FROM tipo_productos
                     WHERE estado <> 'X' 
                     ORDER BY id_tipo_producto DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>tipo_producto</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['tipo_producto']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_tipo_producto"]."' method='post' action='tipo_producto_modificar.php'>
                            <input type='hidden' name='id_tipo_producto' value='".$fila['id_tipo_producto']."'>
                            <a href='javascript:document.formModif".$fila['id_tipo_producto'].".submit();' title='Modificar tipo_producto Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_tipo_producto"]."' method='post' action='tipo_producto_eliminar.php'>
                            <input type='hidden' name='id_tipo_producto' value='".$fila["id_tipo_producto"]."'>
                            <a href='javascript:document.formElimi".$fila['id_tipo_producto'].".submit();' title='Eliminar tipo_producto Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al tipo_producto ".$fila["tipo_producto"]." ?\"))'; location.href='tipo_producto_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
    }

echo "</body>
      </html> ";

 ?>