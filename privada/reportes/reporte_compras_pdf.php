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

            $sql =$db->Prepare("SELECT CONCAT_WS(' ',pr.nombre,pr.apellido) AS proveedor,pr.empresa,co.monto,co.fec_compra
            FROM compras co
            INNER JOIN proveedores pr ON co.id_proveedor=pr.id_proveedor
            WHERE co.estado <> 'X'
            AND pr.estado <> 'X'
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
                    <td align='center'  width='80%'><h1>REPORTES DE COMPRAS</h1></td>
                    </tr>
                    </table>";
                echo"
                <center>
                    <table border='1' cellspacing='0'>
                    <tr>
                    <th>Nro</th><th>PROVEEDOR</th><th>EMPRESA</th><th>MONTO</th><th>FECHA COMPRA</th>
                    </tr>";
                    $b=1;
                foreach ($rs as $k => $fila) {                                       
                    echo"<tr>
                            <td align='center'>".$b."</td>
                            <td>".$fila['proveedor']."</td>
                            <td>".$fila['empresa']."</td>
                            <td>".$fila['monto']."</td>
                            <td><i>".$fila['fec_compra']."</i></td>
                        </tr>";
                    $b=$b+1;
                }
                echo"</table><br>
                <b>fecha :</b>".$fecha."</center>";   
        }
        echo "</body>
        </html> ";

?>
            



