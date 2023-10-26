"use strict"
function buscar_pruebas(){
        var d1, d2, d3, d4,d11, ajax, url, param, contenedor;
            contenedor = document.getElementById('pruebas1');
            d1 = document.formu.nomb_esp.value;            
            d2 = document.formu.nomb_pru.value;
            d3 = document.formu.tiempo_duracion_min.value;

            ajax = nuevoAjax();
            url = "ajax_buscar_pruebas.php"
            param = "nomb_esp="+d1+"&nomb_pru="+d2+"&tiempo_duracion_min="+d3;
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