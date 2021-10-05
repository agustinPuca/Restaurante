<?php
session_start();
require_once ('../Libs/Header.php');
require_once('../Libs/MenuAdministrador.php');
?>
<?php
	
	$sql="select i.*,Nombre_cat_insumo  from Insumos i inner join categoria_insumo ci on i.idCategoria_Insumo=ci.idCategoria_Insumo ";
$Insumos= prepare_select($conexion,$sql);
$campos=$Insumos->fetch_fields(); //Devuelve un array de objetos que representan los campos de un conjunto de resultados

//var_dump($Insumos);
?>	
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloIndex.css">
	</head>
	<!--Tabla de Productos-->
		<div class="todo col-11 mx-auto ">
		<nav class="navbar navbar-light justify-content-between" style="background-color:rgb(108,059,042)">
											<a href="CreateInsumo.php"  ><h2> <i class="lista fas fa-plus-circle text-white ml-5"></i></h2></a>
											<h4 class="titulolista  text-white ">Lista de Insumos</h4>
											<form>
													 <input type="text"  placeholder = "uscar Insumo" name="buscador" onkeyup="showHint(this.value)">
											</form>
									</nav>
			
				<div class="table-responsive">	
				<table class="table bg-light text-center"  >
							
                            <thead  class="text-center" >
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
									<th>Categoria</th>
                                    <th>Acciones</th>
							</thead >
						<tbody   id="table">
							<?php 
									foreach($Insumos as $fila)
								{
									echo '<tr>';

											echo '<td>'.$fila['Nombre_Insumo'].'</td>';							
											echo '<td>'.$fila['Descripcion_Insumo'].'</td>';
											echo '<td>'.$fila['Nombre_cat_insumo'].'</td>';
                                            echo '<td><div class="botones d-flex   ">
                                                        <div class="p-1"><a href="updateInsumo.php?idInsumo='.$fila["idInsumo"].'"class="btn btn-primary btn-sm"><i class="far fa-edit mr-1"></i>Modificar</a></div> 
                                                        <div class=" p-1"><a href="DeleteInsumo.php?idInsumo='.$fila["idInsumo"].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt mr-1"></i>Eliminar</a></div> 
                                                        </div> 
                                                  </td> 
                                        </tr>';
								}
							?>	
						</tbody>
						
								
						
					</table>
							</div>
				</div>
		</div>
		<script>
function showHint(str) {
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				document.getElementById("table").innerHTML = this.responseText;
            }
		};
		if (str.length == 0) {
					xmlhttp.open("GET", "insumo.php?q=" + "");
					xmlhttp.send();
			}else{
					xmlhttp.open("GET", "insumo.php?q=" + str, true);
					xmlhttp.send();
				} 
	
    
}
</script>	
	<br>	
								
	<!--Pie de Pagina-->
	<?php require_once ('../Libs/Footer.php'); ?>