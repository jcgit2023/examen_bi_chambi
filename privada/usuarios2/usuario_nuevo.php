<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript'>
         function buscar() {
          var d1, contenedor, url;
          contenedor = document.getElementById('asociaciones');
          contenedor2 = document.getElementById('asociacion_seleccionado');
          contenedor3 = document.getElementById('asociacion_insertada');
          d1 = document.formu.nomb_asoci.value;
          d2 = document.formu.dir_as.value;
          d3 = document.formu.tel_as.value;
          ajax = nuevoAjax();
          url = 'ajax_buscar_asociacion.php'
          param = 'nomb_asoci='+d1+'&dir_as='+d2+'&tel_as='+d3;
          ajax.open('POST', url, true);
          ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
          ajax.onreadystatechange = function(){
              if (ajax.readyState == 4){
                  contenedor.innerHTML = ajax.responseText;
                  contenedor2.innerHTML = '';
                  contenedor3.innerHTML = '';
              }
          }
          ajax.send(param);
      }

          function buscar_asociacion(id_asociacion) {
            var d1, contenedor, url;
            contenedor = document.getElementById('asociacion_seleccionado');
            contenedor2 = document.getElementById('asociaciones');
            document.formu.id_asociacion.value = id_asociacion;

            d1 = id_asociacion;
          
            ajax = nuevoAjax();
            url = 'ajax_buscar_asociacion1.php';
            param = 'id_asociacion='+d1;
            ajax.open('POST', url, true);
            ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4){
                    contenedor.innerHTML = ajax.responseText;
                    contenedor2.innerHTML = '';
                }
            }
            ajax.send(param);
        }


        function insertar_asociacion() {
          var d1, contenedor, url;
          contenedor = document.getElementById('asociacion_seleccionado');
          contenedor2 = document.getElementById('asociaciones');
          contenedor3 = document.getElementById('asociacion_insertada');
          d1 = document.formu.nomb_asoci1.value;
          d2 = document.formu.fe_cre_as1.value;
          d3 = document.formu.dir_as1.value;
          d4 = document.formu.tel_as1.value;
          d5 = document.formu.corr_as1.value;
          d6 = document.formu.hor_en_am_as1.value;
          d7 = document.formu.hor_sa_am_as1.value;
          d8 = document.formu.hor_en_pm_as1.value;
          d9 = document.formu.hor_sa_pm_as1.value;
          if (d1 == '') {
                alert('El nombre es incorrecto o el campo esta vacio');
                document.formu.nomb_asoci1.focus();
                return;
            }
          if  ((d2=='')) {
                alert('Por favor introduzca una Fecha');
                document.formu.fe_cre_as1.focus();
                return;
            }
          if  (d3 == '') {
                alert('Por favor introduzca una direccion');
                document.formu.dir_as1.focus();
                return;
          }
          if  (d4 == '') {
            alert('Por favor introduzca un telefono');
            document.formu.tel_as1.focus();
            return;
          }
          if  (d6 == '') {
            alert('Por favor introduzca una hora entrada am');
            document.formu.hor_en_am_as1.focus();
            return;
          }
          if  (d7 == '') {
            alert('Por favor introduzca una hora salida am');
            document.formu.hor_sa_am_as1.focus();
            return;
          }
          if  (d8 == '') {
            alert('Por favor introduzca una hora entrada pm');
            document.formu.hor_en_pm_as1.focus();
            return;
          }
          if  (d9 == '') {
            alert('Por favor introduzca una hora salida pm');
            document.formu.hor_sa_pm_as1.focus();
            return;
          }
          ajax = nuevoAjax();
          url = 'ajax_inserta_asociacion.php'
          param = 'nomb_asoci1='+d1+'&fe_cre_as1='+d2+'&dir_as1='+d3+'&tel_as1='+d4+'&corr_as1='+d5+'&hor_en_am_as1='+d6+'&hor_sa_am_as1='+d7+'&hor_en_pm_as1='+d8+'&hor_sa_pm_as1='+d9;
          ajax.open('POST', url, true);
          ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
          alert('llega');
          ajax.onreadystatechange = function(){
              if (ajax.readyState == 4){
                  contenedor.innerHTML = '';
                  contenedor2.innerHTML = '';
                  contenedor3.innerHTML = ajax.responseText;
              }
          }
          ajax.send(param);
      }

      </script>
    </head>";
    echo"<body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='clubes.php'>Listado de Clubes</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
      <h1>INSERTAR CLUB</h1>";
      
      $sql = $db->Prepare("SELECT nomb_asoci,dir_as,tel_as,id_asociacion
      FROM asociacion2                       
          ");
$rs = $db->GetAll($sql);
/*  if ($rs) {*/
echo"<form action='clubes_nuevo1.php' method='post' name='formu'>";
echo"<center>
  <table class='listado'>
    <tr>
      <th>(*)Seleccionar ala Asociacion</th>
      <td>
      <table>
       <tr>
       <td>
              <b>Asociacion</b><br />
              <input type='text' name='nomb_asoci' value='' size='10' onKeyUp='buscar()'>
            </td>
            <td>
              <b>Direccion</b><br />
              <input type='text' name='dir_as' value='' size='10' onKeyUp='buscar()'>
            </td>
            <td>
              <b>Telefono</b><br />
              <input type='text' name='tel_as' value='' size='10' onKeyUp='buscar()'>
              </td>
              </tr>
            </table>
          </td>
        </tr>";
    echo"<tr>
          <td colspan ='6' align='center'>
           <table width='100%'>
           <tr>
           <td colspan='3' align='center'>
          <div id='asociaciones'></div>
          </td>
          </tr>
          </table>
          </td>
          </tr>
          <tr>
          <td colspan='6' align='center'>
            <table width='100%'>
            <tr>
            <td colspan='3'>
            <div id='asociacion_seleccionado'></div>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            <tr>
            <td colspan='6' align='center'>
            <table width='100%'>
            <tr>
            <td colspan='3'>
            <input type='hidden' name='id_asociacion'>
            <div id='asociacion_insertada'></div>
            </td>
            </tr>
            </table>
            </td>
            </tr>";
echo"<tr>
<th><b>(*)Nombre de Club</b></th>
<td><input type='text' name='nomb_cl' size='10'></td>
</tr>
<tr>
<th><b>(*)Fecha creacion</b></th>
<td><input type='date' name='fec_cre_cl' size='10'></td>
</tr>
<tr>
<th><b>(*)Direccion</b></th>
<td><input type='text' name='dir_cl' size='10'></td>
</tr>
<tr>
<th><b>(*)Telefono</b></th>
<td><input type='text' name='tel_cl' size='10'></td>
</tr>
<tr>
<th><b>Correo</b></th>
<td><input type='text' name='corr_cl' size='10'></td>
</tr>
<tr>
<th><b>(*)Hora entrada mañana</b></th>
<td><input type='time' name='hor_en_am_cl' size='10'></td>
</tr>
<tr>
<th><b>(*)Hora salida mañana</b></th>
<td><input type='time' name='hor_sa_am_cl' size='10'></td>
</tr>
<tr>
<th><b>(*)Hora entrada tarde</b></th>
<td><input type='time' name='hor_en_pm_cl' size='10'></td>
</tr>
<tr>
<th><b>(*)Hora salida tarde</b></th>
<td><input type='time' name='hor_sa_pm_cl' size='10'></td>
</tr>
    
    <tr>
      <td align='center' colspan='2'>  
        <input type='submit' value='ADICIONAR USUARIO'><br>
        (*)Datos Obligatorios
      </td>
    </tr>
  </table>
  </center>";
echo"</form>" ;     
/*}*/

echo "</body>
</html> ";

?>