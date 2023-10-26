"use strict"
function mostrar(id_prueba) {
    var d1, ventanaCalendario;
    d1=id_prueba;
    
    ventanaCalendario=window.open("ficha_tec_pruebas1.php?id_prueba=" +d1 , "calendario","width=600, heigth=550, left=100, top=100,scrollbars=yes,menubars=no, statusbar=NO,status=NO,resizable=YES,location=NO")
}