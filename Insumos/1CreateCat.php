<?php
ob_start();
?>												
<?php
session_start();
require_once ('../Libs/header.php');
require_once('../Libs/MenuAdministrador.php');

date_default_timezone_set("America/Buenos_Aires");
?>
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloCategoria.css">
	</head>
<?php

	if(isset($_POST["insertar"])) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
				{
					$items1		 =($_POST["Nombre"]);
					$items2		 =($_POST["Descripcion"]);
					//Separar valores de arrays,en este caso son 6 arrays uno por cada input
					while(true)
					{
									//recuperar los valores de los arreglos
									$item1=current($items1);
									$item2=current($items2);
									//Asignarlos a variables
									$nombre			=(($item1 !== false) ? $item1 : ", &nbsp;");
									$descripcion	=(($item2 !== false) ? $item2 : ", &nbsp;");
									$campos=array($nombre,$descripcion);
									$sql="insert into categoria_insumo(Nombre_cat_insumo,Descripcion_cat_inssumo) values(?,?)";
									$datos=prepare_query($conexion,$sql,$campos);
									if($datos)
										{
														header("Location: 1IndexCat.php");
										}
									else
										{
										$msg ='No se Guardo Error:'.$sql.'</br>'.$cmd->error;	
										}
													//proximo valor
													$item1= next($items1);
													$item2= next($items2);
													//check terminator
													if($item1 === false && $item2===false )break;
									}
								}
							
							else{
								$msg='';
							}

?>
				
<div class="todo container col-11">
			
						<form class="form-row  mx-auto " id="form"  action="1CreateCat.php" method="POST" enctype="multipart/form-data">
						<div class="table-responsive">
						<table class="table bg-light" id="tabla">
									<thead  class="text-center text-white" style="background-color:rgb(108,059,042)" >
										<th colspan="1"><h4><a href="1IndexCat.php"class="titulo3create" ><i class="fas fa-list text-white "></i></a></h4></th>
											<th colspan="2" ><h4 class="titulo4create">Agregar Categoria de Insumo</h4></th>
									</thead >
									<thead  class="text-center" >
											
											<th>Nombre</th>
											<th>Descripcion</th>
											<th></th>
									</thead >
										<tr class="fila-fija text-center ">		
													<td>
															<!--Nombre del Producto-->
															<div  class = "form-group col-md-" id = "user-group">
																
																<input type="text" placeholder = "Nombre" class = "cuadro form-control" required name="Nombre[]" id="Nombre"/>
															</div>
													</td>
													<td>
															<!--Nombre del Descripcion-->
															<div   class = "form-group " id = "user-group">
																
																	<input class = "cuadro form-control" placeholder = "Descripcion" name="Descripcion[]" > </input>
															</div>
													</td>
													
													
													

														<td class="eliminar ">
														<a type="button" class="  " ><h2><i class="fas fa-times-circle text-danger"></i></h2></a>													</td>
									</table>
																		</div>
										<div class="btn-der ">
											<input type="submit" name="insertar" value="Guardar" class="btn btn-info"/>
											<button id="adicional" name="adicional" type="button" class=" btn btn-success">Agregar</button>
										</div>
						</form> 
						<!-- Mensaje de la ejecucion-->
								<?php if(!empty($msg)){?>
								<div class="alert alert-danger my-3" role="alert">
								<?php echo $msg;?>
								</div> 
							<?php }
							if(!empty($msg1)){?>
							<div class="alert alert-success my-3" role="alert">
								<?php echo $msg1;?>
								</div> 
							<?php }?>							
				
                              
		
</div>

<script >
	$(function(){
		//clona la fila oculta que tiene los campos bases y lo agrega al final de la tabla
		$("#adicional").on('click', function(){
			$("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
		});
		//Evento que selecciona la fila y la elimina
		$(document).on("click",".eliminar",function(){
			var parent = $(this).parents().get(0);
			$(parent).remove();
		});
	});
</script>
<br>
<br>
<br>
<br>
<?php require_once('../Libs/footer.php')?>

<?php
		ob_end_flush();
?>