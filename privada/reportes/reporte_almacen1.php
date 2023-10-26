<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;
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

            $sql =$db->Prepare("SELECT tp.tipo_producto,pr.nombre,al.cantidad
            FROM almacen al
            INNER JOIN productos pr ON al.id_producto=pr.id_producto
            INNER JOIN tipo_productos tp ON tp.id_tipo_producto=pr.id_tipo_producto
            WHERE al.estado <> 'X'
            AND pr.estado <> 'X'
            AND tp.estado <> 'X'
                    ");
$rs = $db->GetAll($sql);
            $sql1 =$db->Prepare("SELECT *
                            FROM mini_super
                            WHERE id_tienda = 1
                            AND estado <> 'X'
                            ");
            $rs1 = $db->GetAll($sql1);
            $nombres = $rs1[0]["nombre"];
            $logo = $rs1[0]["logo"];
            $fecha = date("Y-m-d H:i:s");

            if($rs){
                echo"<table width='100%' border='0'>
                <tr>
                    <td><img src='../tienda_lucy/logos/{$logo}' width='70%'></td>
                    <td align='center'  width='80%'><h1>REPORTES DE ALMACEN Y PRODUCTOS</h1></td>
                    </tr>
                    </table>";
                echo"
                <center>
                    <table border='1' cellspacing='0'>
                    <tr>
                    <th>Nro</th><th>PRODUCTO</th><th>TIPO PRODUCTO</th><th>CANTIDAD</th>
                    </tr>";
                    $b=1;
                foreach ($rs as $k => $fila) {                                       
                    echo"<tr>
                            <td align='center'>".$b."</td>
                            <td>".$fila['nombre']."</td>
                            <td>".$fila['tipo_producto']."</td>
                            <td><i>".$fila['cantidad']."</i></td>
                        </tr>";
                    $b=$b+1;
                }
                echo"</table><br>
                <b>fecha :</b>".$fecha."</center>";   
        }
        echo "</body>
        </html> ";

?>
            



