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
			<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">	
	</head>
	<!--Tabla de Productos-->
<div class="todo col-11 mx-auto text-white">
									<nav class="navbar navbar-light justify-content-between" style="background-color:rgb(108,059,042);height:50px">
											<a href="CreateInsumo.php"  ><h2> <i class="lista fas fa-plus-circle text-white ml-5"></i></h2></a>
											<h4 class="titulolista  text-white ">Lista de Insumos</h4>
									</nav>
	
				<table class="table bg-light text-center table-sm" id="tablax" style="position: relative;top: -30px">
							
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
<br>	
<br>								
<!--Pie de Pagina-->
<?php require_once ('../Libs/Footer.php'); ?>