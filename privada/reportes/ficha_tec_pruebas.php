<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=uft-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_pruebas.js'></script>
         <script type='text/javascript' src='js/mostrar_pruebas.js'></script>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' 
       value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;
       ' class='boton_cerrar'></a>";
         
        echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
	      echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
       echo"<h1>FICHA TECNICA PRUEBAS</h1>";
       $sql = $db->Prepare("SELECT nomb_esp
                     FROM especialidades                      
                        ");
        $rs = $db->GetAll($sql);

echo"
<!-----------  INICIO BUSCADOR  ----------->
    <center>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
      <tr>
        <th>
        <select name='nomb_esp' onChange='buscar_pruebas()'>
          <option value=''>--Especialidad--</option>";
          foreach ($rs as $k => $fila) {
          echo"<option value='".$fila['nomb_esp']."'>".$fila['nomb_esp']."</option>";    
          }  

  echo"</select>
        </th>
        <th>
          <b>NOMBRE PRUEBA</b><br />
          <input type='text' name='nomb_pru' value='' size='10' onKeyUp='buscar_pruebas()'>
        </th>
        <th>
          <b>TIEMPO DURACION MINIMO</b><br />
          <input type='text' name='tiempo_duracion_min' value='' size='10' onKeyUp='buscar_pruebas()'>
        </th>
      </tr>
    </table>
    </form>
    </center>
    <!---------- FIN BUSCADOR ---------->";

    echo"<div id='pruebas1'>";
    echo"</div>";
    echo"</body>
        </html>";
?>