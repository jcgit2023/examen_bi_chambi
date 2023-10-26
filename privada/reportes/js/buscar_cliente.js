"use strict"
function buscar_clientes(){
        var d1, d2, d3, ajax, url, param, contenedor;
            contenedor = document.getElementById('clientes1');
            d1 = document.formu.nombre.value;            
            d2 = document.formu.apellido.value;
            d3 = document.formu.telefono.value;

            ajax = nuevoAjax();
            url = "ajax_buscar_cliente.php"
            param = "nombre="+d1+"&apellido="+d2+"&telefono="+d3;
            //alert(param);
            ajax.open("POST", url, true);
            ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4){
                    contenedor.innerHTML = ajax.responseText;
                }
            }
            ajax.send(param);
}