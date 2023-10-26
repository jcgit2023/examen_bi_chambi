"use strict"
function buscar_inmuebles(){
        var d1, d2, d3, ajax, url, param, contenedor;
            contenedor = document.getElementById('inmuebles1');
            d1 = document.formu.material.value;            
            d2 = document.formu.superficie.value;
            d3 = document.formu.numero_dormitorios.value;

            ajax = nuevoAjax();
            url = "ajax_buscar_inmueble.php"
            param = "material="+d1+"&superficie="+d2+"&numero_dormitorios="+d3;
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