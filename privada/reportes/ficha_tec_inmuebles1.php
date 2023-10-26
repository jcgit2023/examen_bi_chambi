<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$id_inmueble = $_REQUEST["id_inmueble"];

$sql = $db->Prepare("SELECT inmu.*, t_inmu.tipo_inmueble
                    FROM inmuebles inmu
                    INNER JOIN tipos_inmuebles t_inmu ON t_inmu.id_tipo_inmueble=inmu.id_tipo_inmueble 	 					
                    WHERE id_inmueble = ?
                    AND t_inmu.id_tipo_inmueble<>0
                    AND inmu.id_inmueble<>0
                    ");
$rs = $db->GetAll($sql, array($id_inmueble));

$sql1 = $db->Prepare("SELECT *
		 			FROM mini_super		 							 					
                    WHERE id_tienda=1
					AND estado = 'A'
					");
$rs1 = $db->GetAll($sql1);

$nombre =$rs1[0]["nombre"];
$logo =$rs1[0]["logo"];

echo"<html>
        <head>
             <script type='text/javascript'>
            var ventanaCalendario=false
                function imprimir() {
                    if (confirm(' Desea Imprimir ?')){
                        window.print();
                    }
                }
            </script>
        </head>
            <body style='cursor:hand' onClick='imprimir();'>";
            if($rs){
                echo"<table width='100%' border='0'>
                <tr>
                    <td><img src='../mini_super/logos/{$logo}' width='70%'></td>
                    <td align='center'  width='80%'><h1>FICHA TECNICA DE INMUEBLES</h1></td>
                    </tr>
                    </table>";
            echo"
            <center>
              <table border='1' cellspacing='0'>";
              $b=1;
              foreach ($rs as $k => $fila) {
            echo"
                 <tr>
                    <th aling='right'>Material</th><th>;</th>
                    <td><input type='text' name='material' value='".$fila['material']."' disabled='' size='35'> </td>
                 </tr>
                 <tr>
                    <th aling='right'>Superficie</th><th>;</th>
                    <td><input type='text' name='superficie' value='".$fila['superficie']."' disabled='' size='35'> </td>
                 </tr>
                 <tr>
                    <th aling='right'>Numero Dormitorios</th><th>;</th>
                    <td><input type='text' name='numero_dormitorios' value='".$fila['numero_dormitorios']."' disabled='' size='35'> </td>
                 </tr>
                 <tr>
                    <th aling='right'>Precio</th><th>;</th>
                    <td><input type='text' name='precio' value='".$fila['precio']."' disabled='' size='35'> </td>
                </tr>
                <tr>
                    <th aling='right'>Descripcion</th><th>;</th>
                    <td><input type='text' name='descripcion' value='".$fila['descripcion']."' disabled='' size='35'> </td>
                </tr>
                <tr>
                    <th aling='right'>Tipo Inmueble</th><th>;</th>
                    <td><input type='text' name='tipo_inmueble' value='".$fila['tipo_inmueble']."' disabled='' size='35'> </td>
                </tr>
                    </table>";
                    $b=$b+1;
                }
            }
        echo"</body>
        </html> ";
        ?>
