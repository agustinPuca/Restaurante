<?php
session_start();
require_once ('../Libs/Header.php');
require_once('../Libs/MenuAdministrador.php');
?>
<?php
	
	$sql="select idCategoria_menu, Nombre_cat_menu,Descripcion_cat_menu from categoria_menu ORDER BY Nombre_cat_menu ASC";
$Menus= prepare_select($conexion,$sql);
$campos=$Menus->fetch_fields(); //Devuelve un array de objetos que representan los campos de un conjunto de resultados

//var_dump($Menus);
?>	
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloProducto.css">
	</head>
	<!--Tabla de Menus-->
		<div class="todo col-11 mx-auto ">
				<div class="row text-center">
				
				<div class="table-responsive">	
				<table class="table  bg-light table-sm">
							<thead style="background-color:rgb(108,059,042)">
										<th colspan="1"><a href="Create.php"  ><h2> <i class="fas fa-plus-circle text-white"></i></h2></a></th>
										<th colspan="5" ><h4 class="titulo text-white ">Lista de Categorias</h4></th>
								</thead >
						<thead>
						
							<?php 
							foreach($campos as $campo){
									
									echo '<th>'.($campo->name).'</th>';//substr saco la primera letra
								}
								echo '<th>Acciones</th>';
							?>
						</thead>
						<tbody>
							<?php 
									foreach($Menus as $fila)
								{
										echo '<tr>';

										foreach($campos as $campo)
										{
											echo '<td>'.$fila[$campo->name].'</td>';							
										}
									echo '<td><div class="botones d-flex   ">
											<div class="p-1"><a href="update.php?idCategoria_menu='.$fila["idCategoria_menu"].'"class="btn btn-primary btn-sm"><i class="far fa-edit mr-1"></i>Modificar</a></div> 
											<div class=" p-1"><a href="delete.php?idCategoria_menu='.$fila["idCategoria_menu"].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt mr-1"></i>Eliminar</a></div> 
                                            <div class="p-1"><a href="Productos.php?idCategoria_menu='.$fila["idCategoria_menu"].'"class="btn btn-success btn-sm"><i class="fas fa-utensils mr-1"></i>Menu</a></div> 
                                            </div> </td> </tr>';
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
	<!--Pie de Pagina-->
	<?php require_once ('../Libs/Footer.php'); ?>