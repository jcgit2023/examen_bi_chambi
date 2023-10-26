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

            $sql =$db->Prepare("SELECT CONCAT_WS(' ',per.nombres,per.ap,per.am) as persona, u.*
                    FROM personas per
                    INNER JOIN usuarios u ON u.id_persona=per.id_persona
                    WHERE u.estado='A' AND per.estado='A'
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
                    <td align='center'  width='80%'><h1>REPORTES DE PERSONAS CON FECHAS DE INSERCION</h1></td>
                    </tr>
                    </table>";
                echo"
                <center>
                    <table border='1' cellspacing='0'>
                    <tr>
                    <th>Nro</th><th>PERSONAS</th><th>NOMBRE DE USUARIO</th>
                    </tr>";
                    $b=1;
                foreach ($rs as $k => $fila) {                                       
                    echo"<tr>
                            <td align='center'>".$b."</td>
                            <td>".$fila['persona']."</td>
                            <td><i>".$fila['usuario1']."</i></td>
                        </tr>";
                    $b=$b+1;
                }
                echo"</table><br>
                <b>fecha :</b>".$fecha."</center>";   
        }
        echo "</body>
        </html> ";

?>
            



