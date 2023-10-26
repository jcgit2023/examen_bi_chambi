<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=uft-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_cliente.js'></script>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='clientes_nuevo.php'>Nuevo Cliente</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' 
       value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;
       ' class='boton_cerrar'></a>";
         
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
      echo"<h1>LISTADO DE CLIENTES</h1>";

      echo"
      <!-----------  INICIO BUSCADOR  ----------->
          <center>
          <form action='#'' method='post' name='formu'>
          <table border='1' class='listado'>
            <tr>
              <th>
               <b>Nombre</b><br />
               <input type='text' name='nombre' value='' size='10' onKeyUp='buscar_clientes()'>
              </th>
              <th>
                <b>Apellido</b><br />
                <input type='text' name='apellido' value='' size='10' onKeyUp='buscar_clientes()'>
              </th>
              <th>
                <b>Telefono</b><br />
                <input type='text' name='telefono' value='' size='10' onKeyUp='buscar_clientes()'>
              </th>
               
            </tr>
           </table>
       </form>
       </center>
<!---------- FIN BUSCADOR ---------->";
      
echo"<div id='clientes1'>";

$sql = $db->Prepare("SELECT *
                     FROM clientes
                     WHERE estado <> 'X' 
                     ORDER BY id_cliente DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>NOMBRE</th><th>APELLIDO</th><th>TELEFONO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['nombre']."</td>
                        <td>".$fila['apellido']."</td>
                        <td>".$fila['telefono']."</td>
                        
                        <td align='center'>
                          <form name='formModif".$fila["id_cliente"]."' method='post' action='clientes_modificar.php'>
                            <input type='hidden' name='id_cliente' value='".$fila['id_cliente']."'>
                            <a href='javascript:document.formModif".$fila['id_cliente'].".submit();' title='Modificar Cliente Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_cliente"]."' method='post' action='clientes_eliminar.php'>
                            <input type='hidden' name='id_cliente' value='".$fila["id_cliente"]."'>
                            <a href='javascript:document.formElimi".$fila['id_cliente'].".submit();' title='Eliminar Cliente Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al cliente ".$fila["nombre"]." ".$fila["apellido"]." ?\"))'; location.href='cliente_eliminar.php''> 
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
    echo"</div>";
echo "</body>
      </html> ";

 ?>