<?php
session_start();
require_once ('../Libs/header.php');
require_once('../Libs/MenuAdministrador.php');
?>
	<?php
		$sql="select m.idMenu, m.Codigo_Menu, m.Nombre_Menu, m.Descripcion_Menu, m.Precio_Menu, i.NombreArchivo,cm.Nombre_Cat_menu from menu m inner join Imagenes i on m.idImagen=i.idImagen inner join producto_categoria pc on m.idMenu=pc.idMenu inner join categoria_menu cm on pc.idCategoria_Menu=cm.idCategoria_Menu ORDER BY Nombre_menu ASC";
		$productos= prepare_select($conexion,$sql);
			$campos=$productos->fetch_fields(); //Devuelve un array de objetos que representan los campos de un conjunto de resultado
		//var_dump($campos);
	?>	
	<head>
				<!-- css-->
				<link rel="stylesheet" type="text/css" href="Css/EstiloProducto.css">
				<!-- BOOTSTRAP -->
				<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">	
	</head>
	
			<div class="todo container text-white" >
											<nav class="navbar navbar-light justify-content-between " style="background-color:rgb(108,059,042);height:50px">
													<h3><a href="Create.php"><h3><i class="fas fa-plus-circle text-white "></i></h3></a></h3>
													<h3 class="titulo1">Menu</h3>
											</nav>
						<table id="tablax" class="table bg-light    table-sm " style="position: relative;top: -30px">
										<thead>
												<th class="text-center">Imagen</th>
												<th class="text-center">Nombre</th>
												<th class="text-center">Descripcion</th>
												<th class="text-center">Precio</th>
												<th class="text-center">Categoria</th>
												<th class="text-center">Acciones</th>
										</thead>
											<tbody >
												<?php 
														foreach($productos as $fila)
													{
															echo '<tr>';
															echo '<td> <img src="/Restaurante/Imagenes/'. $fila['NombreArchivo'].'" class="img  mx-auto"   alt="Card image cap" /></td>';		
															echo '<td>'.$fila['Nombre_Menu'].'</td>';	
															echo '<td>'.$fila['Descripcion_Menu'].'</td>';
															echo '<td> $ '.$fila['Precio_Menu'].'</td>';
															echo '<td>'.$fila['Nombre_Cat_menu'].'</td>';
														echo '<td><div class="botones d-flex   ">
																<div class="p-1 "><a href="update.php?idMenu='.$fila["idMenu"].'"class="btn btn-primary btn-sm"><i class="far fa-edit mr-1"></i>Modificar</a></div> 
																<div class="p-1  "><a href="delete.php?idMenu='.$fila["idMenu"].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt mr-1"></i>Eliminar</a></div> 
														</div> </td> </tr>';
													}
												?>	
											</tbody>
								</table>
							
			
			</div>
   <!-- JQUERY -->
   <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous">
        </script>
    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">
    </script>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js">
    </script>
<script>
		$(document).ready(function () {
            $('#tablax').DataTable({
                language: {
                    processing: "Tratamiento en curso...",
                    search: "Buscar&nbsp;",
                    lengthMenu: "",
                    info: "Mostrando del item _START_ al _END_ de un total de _TOTAL_ items",
                    infoEmpty: "No existen datos.",
                    infoFiltered: "(filtrado de _MAX_ elementos en total)",
                    infoPostFix: "",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron datos con tu busqueda",
                    emptyTable: "No hay datos disponibles en la tabla.",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Ultimo"
                    },
                    aria: {
                        sortAscending: ": active para ordenar la columna en orden ascendente",
                        sortDescending: ": active para ordenar la columna en orden descendente"
                    }
                },
                //scrollY: 400,
                lengthMenu: [ [8, 25, -1], [10, 25, "All"] ],
            });
        });
</script>		
<br>
<br>
	<!--Pie de Pagina-->
	<?php require_once ('../Libs/Footer.php'); ?>				
