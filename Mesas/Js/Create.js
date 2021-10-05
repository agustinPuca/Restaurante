
        function  borrar(){
            document.getElementById("boton").reset ;
        }
        function showHint(str) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("table").innerHTML = this.responseText;
                    }
                };
                    if (str.length == 0) {
                            xmlhttp.open("GET", "mesa.php?q=" + "");
                            xmlhttp.send();
                    }else{
                            xmlhttp.open("GET", "mesa.php?q=" + str, true);
                            xmlhttp.send();
                        } 
            
        }
//update de  la capacidad
  var editando=false;
  function transformarEnEditable(nodo){

//El nodo recibido es SPAN

if (editando == false) {
var nodoTd = nodo.parentNode; //Nodo TD
var nodoTr = nodoTd.parentNode; //Nodo TR
var nodosEnTr = nodoTr.getElementsByTagName('td');

var n_mesa = nodosEnTr[0].textContent; 
var Capacidad = nodosEnTr[1].textContent;


var nuevoCodigoHtml = '<td>'+n_mesa+'<input type="hidden" name="n_mesa" id="n_mesa" value="'+n_mesa+'" size="10"></td> <td><input type="number" name="Capacidad" id="Capacidad" value="'+Capacidad+'" size="5"></td> <td> <button type="submit" name="update" class = "btn btn-primary btn-sm mx-auto col-6" > Guardar </button></td> ';
nodoTr.innerHTML = nuevoCodigoHtml;

editando = "true";}
else {alert ('Solo se puede editar una línea. Recargue la página para poder editar otra');
}

}


function anular(){
window.location.reload();
}

