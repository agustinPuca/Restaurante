<!DOCTYPE html>

<html> <head> <title>Portal web - aprenderaprogramar.com</title> <meta charset="utf-8">
<?php 
 require_once ('Libs/header.php');
    if(isset($_POST['n_mesa'])){
            $n_mesa=$_POST['n_mesa'];
            $capacidad=$_POST['Capacidad'];
            echo  'daaa'.$n_mesa.$capacidad;
            $sql="update mesas SET Capacidad=? where idMesa=?";
                $datos1=prepare_query($conexion,$sql,[$capacidad,$n_mesa]);
    }
?> 
<style>
    /* Curso JavaScript estilos aprenderaprogramar.com*/

body {font-family: Arial, Helvetica, sans-serif; background-color: #FFF8DC;}
table { font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif; font-size: 12px; margin: 45px; width: 550px;
    text-align: center; border-collapse: collapse; }
th { font-size: 13px; font-weight: normal; padding: 8px; background: #b9c9fe; border-top: 4px solid #aabcfe;
    border-bottom: 1px solid #fff; color: #039; }
td { padding: 8px; background: #e8edff; border-bottom: 1px solid #fff; color: #669; border-top: 1px solid transparent; }
tr:hover td { background: #d0dafd; color: #339; }
.editar {color: blue; cursor:pointer;}
#contenedorForm {margin-left: 45px; font-size:12px;}
.boton {   color: black; padding: 5px; margin: 10px;
  background-color: #b9c9fe;
  font-weight: bold; }
</style>

<script>
  var editando=false;

 

function transformarEnEditable(nodo){

//El nodo recibido es SPAN

if (editando == false) {
var nodoTd = nodo.parentNode; //Nodo TD
var nodoTr = nodoTd.parentNode; //Nodo TR
var nodosEnTr = nodoTr.getElementsByTagName('td');

var n_mesa = nodosEnTr[0].textContent; 
var Capacidad = nodosEnTr[1].textContent;


var nuevoCodigoHtml = '<td><input type="text" name="n_mesa" id="n_mesa" value="'+n_mesa+'" size="10"></td> <td><input type="text" name="Capacidad" id="Capacidad" value="'+Capacidad+'" size="5"></td> <td> <button type="submit" class = "btn btn-primary mx-auto col-6" > Guardar </button></td> ';
nodoTr.innerHTML = nuevoCodigoHtml;

editando = "true";}
else {alert ('Solo se puede editar una línea. Recargue la página para poder editar otra');
}

}


function anular(){
window.location.reload();
}
</script>
</head>
<body>
<?php
		session_start();
        require_once ('Libs/header.php');
        require_once ('Libs/MenuCajero.php');
?>
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/Create.css">
</head>
<?php
$sql="select * from mesas";
$mesas=prepare_select($conexion,$sql);?>
<div class="todo container col-11">
									
				<div class="table-responsive">	
            <form class="form-inline " action="Ejupdate.php" method="POST" enctype="multipart/form-data"> 
				<table >
							
                            <thead  class="text-center" >
                                    <th>N° Mesa</th>
                                    <th>Capacidad</th>
									<th>Acciones</th>
							</thead >
						<tbody  class="text-center" id="table">
							<?php 
									foreach($mesas as $fila)
								{
									echo '<tr >';

											echo '<td height="10">'.$fila['idMesa'].'</td>';							
                                            echo '<td height="10">'.$fila['Capacidad'].'</td>';
                                            echo '<td><span class="editar" onclick="transformarEnEditable(this)">Editar</span></td>                                                       

                                        </tr>';
								}
							?>	
						</tbody>
						
						
                    </table>
                            </form>
							</div>
				
</div>
        


</body>

</html>
