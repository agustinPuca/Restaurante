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
			<link rel="stylesheet" type="text/css" href="Css/CreateInsumo.css">
</head>

<?php
// selecciono lo que hay en la tabla categorias para mostrar en el formulario

$sql="select Nombre_cat_insumo from categoria_insumo";
$categorias= prepare_select($conexion,$sql);

			if(isset($_POST["insertar"])) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
				{
					
					$items2		 =($_POST["Nombre_Insumo"]);
					$items3		 =($_POST["Descripcion_Insumo"]);
					$items8		 =($_POST["categoria_insumo"]);
					
					
					//Separar valores de arrays,en este caso son 6 arrays uno por cada input
					while(true)
					{
									//recuperar los valores de los arreglos
									$item2=current($items2);
									$item3=current($items3);
									$item8=current($items8);
									
								//Asignarlos a variables
								$nombre_Insumo		=(($item2 !== false) ? $item2 : ", &nbsp;");
								$descripcion_Insumo	=(($item3 !== false) ? $item3 : ", &nbsp;");
								$categoria_insumo     =(($item8 !== false) ? $item8 : ", &nbsp;");
							
											//Recupero id de la categoria seleccionada
											$sql="SELECT idCategoria_Insumo FROM categoria_insumo WHERE Nombre_cat_insumo=?";
											$cmd=prepare_select($conexion,$sql,[$categoria_insumo]);
										    $fila=$cmd->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
											$idcategoria_insumo=$fila['idCategoria_Insumo'];
										//Concatenar los valores en orden para su futura insercion 
										$campos=array($nombre_Insumo,$descripcion_Insumo,$idcategoria_insumo);
										//sql de insercion de Insumo
										$sql="insert into Insumos(Nombre_Insumo,Descripcion_Insumo,idCategoria_Insumo) values(?,?,?)";
										$datos=prepare_query($conexion,$sql,$campos);
										$idInsumo= $datos->insert_id;
								
											if($datos)
												{// insercion a la tabla Insumo_categoria												
														header("Location: IndexInsumo.php");
												}
											else
												{
													$msg ='No se Guardo Error:'.$sql.'</br>'.$cmd->error;	
												}
									
								//proximo valor
								$item2= next($items2);
								$item3= next($items3);
								$item8= next($items8);
								//check terminator
								if( $item2 === false && $item3===false &&  $item8===false )break;
                    }
                }
			else
				{
					$msg="";
				}
		

?>
				
<div class="todo container col-11">
			
						<form class="form-row  mx-auto " id="form"  action="CreateInsumo.php" method="POST" enctype="multipart/form-data">
						<div class="table-responsive">
						<table class="table bg-light" id="tabla">
									<thead  class="text-center text-white" style="background-color:rgb(108,059,042)" >
										<th colspan="1"><h4><a href="IndexInsumo.php" ><i class="fas fa-list text-white "></i></a></h4></th>
											<th colspan="6" ><h4 class="titulo">Agregar Insumo</h4></th>
									</thead >
									<thead  class="text-center" >
											<th>Nombre</th>
											<th>Descripcion</th>
											<th>Categoria</th>
											<th></th>
									</thead >
										<tr class="fila-fija text-center ">		

													
													<td>
															<!--Nombre del Insumo-->
															<div  class = "form-group col-md-" id = "user-group">
																
																<input type="text"  class = "cuadro form-control" required name="Nombre_Insumo[]" id="Nombre"/>
															</div>
													</td>
							
													<td>
															<!--Nombre del Descripcion-->
															<div   class = "form-group " id = "user-group">
																
																	<input class = "cuadro form-control"  name="Descripcion_Insumo[]" > </input>
															</div>
													</td>
													<td>
															<!--Nombre del Categoria-->		
															<div  class = "grd form-group " id = "user-group">
																	<select class = " form-control "  name="categoria_insumo[]">
																		<?php 
																		foreach($categorias as $fila){?>
																				<option> <?php echo $fila["Nombre_cat_insumo"];?> </option>
																		<?php }?>
																	</select>
															</div>
													</td>
														<td class="eliminar ">
														<a type="button" class="  " ><h2><i class="fas fa-times-circle text-danger"></i></h2></a>
													</td>
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
	//botton de file 
	
	function cambiar(){
		
			var pdrs = document.getElementById('fileimagen').files[0].name;
			document.getElementById('info').innerHTML = pdrs;
		}
	///////////////
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
<?php require_once('../Libs/footer.php')?>

<?php
		ob_end_flush();
?>