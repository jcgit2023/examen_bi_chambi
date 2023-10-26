"use strict"
function buscar_clientes() {
    var d1, d2, d3,d11, ajax, url, param, contenedor;
    contenedor = document.getElementById('clientes1');
    d1 = document.formu.nombre.value;
    d2 = document.formu.apellido.value;
    d3 = document.formu.telefono.value;

    d11=document.formu.nombre.value;
    d11=event.keyCode;
    if((d11==8)&&(d1.length==0)){
        d1='%';
    }

    ajax = nuevoAjax();
    url = "ajax_buscar_cliente.php"
    param = "nombre="+d1+"&apellido="+d2+"&telefono="+d3;
    //alert (param);
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4){
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}