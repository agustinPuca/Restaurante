<?php
session_start();
require_once ('../Libs/Header.php');
require_once('../Libs/MenuAdministrador.php');
?>
<?php
	
	$sql="select * from Proveedores";
$productos= prepare_select($conexion,$sql);
$campos=$productos->fetch_fields(); //Devuelve un array de objetos que representan los campos de un conjunto de resultados

//var_dump($productos);
?>	
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloProveedor.css">
	</head>
	<!--Tabla de Productos-->
		<div class="todo col-11 mx-auto ">
				<div class="row text-center">
				
				<div class="table-responsive">	
				<table class="table  bg-light"  >
							<thead style="background-color:rgb(108,059,042)">
										<th colspan="1"><a href="Create.php"  ><h2> <i class="fas fa-plus-circle text-white"></i></h2></a></th>
										<th colspan="5" ><h4 class="titulolista text-white ">Lista de Proveedores</h4></th>
							</thead >
                            <thead  class="text-center" >
                                    <th>Razon Social</th>
                                    <th>Cuit</th>
									<th>Direccion</th>
                                    <th>Telefono</th>
                                    <th>Area</th>
                                    <th>Acciones</th>
							</thead >
						<tbody>
							<?php 
									foreach($productos as $fila)
								{
									echo '<tr>';

											echo '<td>'.$fila['RazonSocial'].'</td>';							
                                            echo '<td>'.$fila['Cuit'].'</td>';
                                            echo '<td>'.$fila['Direccion'].'</td>';
                                            echo '<td>'.$fila['Telefono_Fijo'].'</td>';
                                            echo '<td>'.$fila['Area'].'</td>';
                                            echo '<td><div class="botones d-flex   ">
                                                        <div class="p-1"><a href="update.php?idProveedor='.$fila["idProveedor"].'"class="btn btn-primary btn-sm"><i class="far fa-edit mr-1"></i>Modificar</a></div> 
                                                        <div class=" p-1"><a href="delete.php?idProveedor='.$fila["idProveedor"].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt mr-1"></i>Eliminar</a></div> 
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
									
	<!--Pie de Pagina-->
	<?php require_once ('../Libs/Footer.php'); ?>