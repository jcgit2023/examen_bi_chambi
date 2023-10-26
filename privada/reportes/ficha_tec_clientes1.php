<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$id_cliente = $_REQUEST["id_cliente"];

$sql = $db->Prepare("SELECT *
                    FROM clientes		 					
                    WHERE id_cliente = ?
                    AND estado = 'A'
                    ");
$rs = $db->GetAll($sql, array($id_cliente));

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
                    <td align='center'  width='80%'><h1>FICHA TECNICA DE CLIENTES</h1></td>
                    </tr>
                    </table>";
            echo"
            <center>
              <table border='1' cellspacing='0'>";
              $b=1;
              foreach ($rs as $k => $fila) {
            echo"
                 <tr>
                    <th aling='right'>Nombre</th><th>;</th>
                    <td><input type='text' name='nombre' value='".$fila['nombre']."' disabled=''> </td>
                 </tr>
                 <tr>
                    <th aling='right'>Apellido</th><th>;</th>
                    <td><input type='text' name='apellido' value='".$fila['apellido']."' disabled=''> </td>
                 </tr>
                 <tr>
                    <th aling='right'>Telefono</th><th>;</th>
                    <td><input type='text' name='telefono' value='".$fila['telefono']."' disabled=''> </td>
                 </tr>
                    </table>";
                    $b=$b+1;
                }
            }
        echo"</body>
        </html> ";
        ?>
