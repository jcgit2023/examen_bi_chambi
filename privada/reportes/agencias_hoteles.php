<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;
echo"<html>
        <head>
        <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
             <script type='text/javascript'>
            var ventanaCalendario=false
                function imprimir() {
                    ventanaCalendario = window.open('agencias_hoteles1.php' , 'calendario', 'width=600, height=550,left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,status=NO,resizable=YES,location=NO')
                }
            </script>
        </head>
            <body>
            <a  href='../../listado_tablas.php'>Listado de tablas</a>
            <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' 
            style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
            echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
            echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
           echo"<h1>REPORTE DE AGENCIAS Y HOTELES</h1>";

$sql =$db->Prepare("SELECT cade.nombre,ho.nombre as nombre_hotel
                    FROM cadena_agencia_viajes cade
                    INNER JOIN hoteles ho ON ho.id_cadena_agencia_viaje=cade.id_cadena_agencia_viaje
                    WHERE ho.id_hotel <> 0 AND cade.id_cadena_agencia_viaje <> 0
                    ");
$rs = $db->GetAll($sql);
if ($rs) {
    echo"<center>
          <table class='listado'>
            <tr>                                   
              <th>Nro</th><th>AGENCIA</th><th>HOTEL</th>
            </tr>";
            $b=1;
        foreach ($rs as $k => $fila) {                                       
            echo"<tr>
                    <td align='center'>".$b."</td>

                    <td>".$fila['nombre']."</td>
                    <td>".$fila['nombre_hotel']."</td>
                 </tr>";
                 $b=$b+1;
        }
         echo"</table>
         <h2>
            <input type='radio' name='seleccionar' onclick='javascript:imprimir()''>Imprimir
         </h2>
      </center>";
    }
echo "</body>
        </html> ";

?>