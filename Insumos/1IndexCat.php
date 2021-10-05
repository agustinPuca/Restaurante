<?php
session_start();
require_once ('../Libs/Header.php');
require_once('../Libs/MenuAdministrador.php');
?>
<?php
	
	$sql="select * from Categoria_insumo";
$Categoria_insumo= prepare_select($conexion,$sql);
$campos=$Categoria_insumo->fetch_fields(); //Devuelve un array de objetos que representan los campos de un conjunto de resultados

//var_dump($Categoria_insumo);
?>	
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloCategoria.css">
	</head>
	<!--Tabla de Productos-->
		<div class="todo col-11 mx-auto ">
				<div class="row text-center">
						<div class="table-responsive">	
								<table class="table  bg-light table-sm"  >
											<thead style="background-color:rgb(108,059,042)">
														<th colspan="1"><a href="1CreateCat.php"  ><h2> <i class="lista fas fa-plus-circle text-white"></i></h2></a></th>
														<th colspan="5" ><h4 class="titulolista text-white ">Lista de Categoria insumo</h4></th>
											</thead >
											<thead  class="text-center" >
													<th>Nombre</th>
													<th>Descripcion</th>
													<th>Acciones</th>
											</thead >
											<tbody>
												<?php 
														foreach($Categoria_insumo as $fila)
													{
														echo '<tr>';

																echo '<td>'.$fila['Nombre_cat_insumo'].'</td>';							
																echo '<td>'.$fila['Descripcion_cat_inssumo'].'</td>';
																echo '<td><div class="botones d-flex   ">
																			<div class="p-1"><a href="1UpdateCat.php?idCategoria_Insumo='.$fila["idCategoria_Insumo"].'"class="btn btn-primary btn-sm"><i class="far fa-edit mr-1"></i>Modificar</a></div> 
																			<div class=" p-1"><a href="1DeleteCat.php?idCategoria_Insumo='.$fila["idCategoria_Insumo"].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt mr-1"></i>Eliminar</a></div> 
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
<br>
<br>
<br>
<br>
<br>
<br>									
	<!--Pie de Pagina-->
	<?php require_once ('../Libs/Footer.php'); ?>