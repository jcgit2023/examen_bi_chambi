<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=uft-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_inmuebles.js'></script>
         <script type='text/javascript' src='js/mostrar_inmueble.js'></script>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' 
       value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;
       ' class='boton_cerrar'></a>";
         
        echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
	      echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
       echo"<h1>FICHA TECNICA INMUEBLES</h1>";

echo"
<!-----------  INICIO BUSCADOR  ----------->
    <center>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
      <tr>
        <th>
          <b>MATERIAL</b><br />
          <input type='text' name='material' value='' size='10' onKeyUp='buscar_inmuebles()'>
        </th>
        <th>
          <b>SUPERFICIE</b><br />
          <input type='text' name='superficie' value='' size='10' onKeyUp='buscar_inmuebles()'>
        </th>
        <th>
          <b>NRO_DORMITORIOS</b><br />
          <input type='text' name='numero_dormitorios' value='' size='10' onKeyUp='buscar_inmuebles()'>
        </th>
      </tr>
    </table>
    </form>
    </center>
    <!---------- FIN BUSCADOR ---------->";

    echo"<div id='inmuebles1'>";
    echo"</div>";
    echo"</body>
        </html>";
?>