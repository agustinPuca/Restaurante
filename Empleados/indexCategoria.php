<?php
session_start();
require_once ('../Libs/Header.php');
require_once('../Libs/MenuAdministrador.php');
?>
<?php
	
	$sql="select idCategoria,Nombre_Categoria,Descripcion from categoria_empleado ORDER BY Nombre_Categoria ASC";
$Categorias= prepare_select($conexion,$sql);
$campos=$Categorias->fetch_fields(); //Devuelve un array de objetos que representan los campos de un conjunto de resultados

//var_dump($Categorias);
?>	
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloIndex.css">
</head>
	<!--Tabla de Categorias-->
<div class="todo col-11 mx-auto ">
		<div class="row text-center">	
				<div class="table-responsive">	
				    <table class="table  bg-light table-sm"  >
							<thead style="background-color:rgb(108,059,042)">
										<th colspan="1"><a href="CategoriaEmpleado.php" class="lista" ><h2> <i class="fas fa-plus-circle text-white"></i></h2></a></th>
										<th colspan="5" ><h4 class="titulo1 text-white ">Lista de Roles</h4></th>
								</thead >
                                <thead >
                            <?php 
                            echo '<th>Nombre</th>';
                            echo '<th>Descripcion</th>';
                            echo '<th>Acciones</th>';
                            ?>
                    </thead>
						<tbody>
							<?php 
									foreach($Categorias as $fila)
								{
									echo '<tr>';
                                        echo '<td>'.$fila['Nombre_Categoria'].'</td>';	
                                        echo '<td>'.$fila['Descripcion'].'</td>';
									echo '<td><div class="botones d-flex   ">
											<div class=" p-1"><a href="deleteCategoria.php?idCategoria='.$fila["idCategoria"].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt mr-1"></i>Eliminar</a></div> 
											<div class=" p-1"><a href="EmpleadosXCategoria.php?idCategoria='.$fila["idCategoria"].'"class="btn btn-success btn-sm">Empleados</a></div> 
											</div> </td> </tr>';
								}
							?>	
						</tbody>
						
								
						
					</table>
                </div>
		</div>
</div>
<?php require_once('../Libs/Footer.php'); ?>