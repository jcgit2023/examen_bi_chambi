"use strict"
function mostrar(id_inmueble) {
    var d1, ventanaCalendario;
    d1=id_inmueble;
    
    ventanaCalendario=window.open("ficha_tec_inmuebles1.php?id_inmueble=" +d1 , "calendario","width=600, heigth=550, left=100, top=100,scrollbars=yes,menubars=no, statusbar=NO,status=NO,resizable=YES,location=NO")
}