<?php
session_start();
require_once ('../Libs/header.php');
    if($_SESSION['Nombre_Categoria']=='Mozo'){
        require_once('../Libs/barramozo.php');
    }
    else{
        require_once('../Libs/MenuCajero.php');
    }
date_default_timezone_set("America/Buenos_Aires");
?>
<?php
	
    $sql="select pc.*, p.RazonSocial from  pedido_compra pc inner join proveedores p on pc.idProveedor=p.idProveedor";
    $Pedidos= prepare_select($conexion,$sql);
$campos=$Pedidos->fetch_fields(); //Devuelve un array de objetos que representan los campos de un conjunto de resultados

//var_dump($Pedidos);
?>	
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="csspedido/EstiloPedido.css">
			<!-- BOOTSTRAP -->
			<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">	
	</head>
	<!--Tabla de Pedidos-->
    <div class="container col-11 my-3  ">
	<div class="table-responsive">
						<? if($_SESSION['Nombre_Categoria']=='Mozo'):?>
							<a href="../Style/IndexMozo.php" class="btn btn-success   "><i class="fas fa-arrow-left mr-2"></i> Menu</a>
						<? else:?>
							<a href="../Style/IndexCajero.php" class="btn btn-success   "><i class="fas fa-arrow-left mr-2"></i> Inicio</a>
						<? endif ?>
				<nav class="navbar navbar-light justify-content-between " style="background-color:rgb(108,059,042);height:50px">
													<h3><a href="CreatePed_mozo.php"><h3><i class="fas fa-plus-circle text-white "></i></h3></a></h3>
													<h4 class="titulolista text-white ">Pedidos de Compra a Proveedor</h4>
											</nav>
						
							<table class="table  bg-light table-sm text-center" id="tablax" style="position: relative;top: -30px" >
										
										<thead  class="text-center" >
												<th>N°</th>
												<th>F.Pedido</th>
												<th>F.Entrega</th>
												<th>Proveedor</th>
												<th>Estado</th>
												<th>Acciones</th>
										</thead >
									<tbody>
										<?php 
												foreach($Pedidos as $fila)
											{
												echo '<tr>';

														echo '<td>'.$fila['idPedido_Compra'].'</td>';							
														echo '<td>'.$fila['Fecha_Pedido'].'</td>';
														echo '<td>'.$fila['Fecha_Entrega'].'</td>';
														echo '<td>'.$fila['RazonSocial'].'</td>';
														$Estado=$fila['Estado'];
														if($Estado=='Recibido')
																{
																	echo '<td class="text-success"><strong>'.$Estado.'</strong></td>';
																}
														else{
															echo '<td class="text-danger"><strong>'.$Estado.'..</strong></td>';
															}	
														echo '<td><div class="botones d-flex   ">
																	<div class="p-1"><a href="update.php?idProveedor='.$fila["idProveedor"].'&idPedido_Compra='.$fila["idPedido_Compra"].'"class="btn btn-primary btn-sm" ">Modificar</a></div> 
																	<div class=" p-1"><a href="delete.php?idPedido_Compra='.$fila["idPedido_Compra"].'"class="btn btn-danger btn-sm">Eliminar</a></div> 
																	<div class=" p-1"><a href="Detalle_mozo.php?idPedido_Compra='.$fila["idPedido_Compra"].'"class="btn btn-info btn-sm">Detalle</a></div> 
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
