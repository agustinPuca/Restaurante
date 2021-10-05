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
			<link rel="stylesheet" type="text/css" href="Css/create.css">
</head>

<?php
// selecciono lo que hay en la tabla categorias para mostrar en el formulario

$sql="select Nombre_cat_menu from categoria_menu";
$categorias= prepare_select($conexion,$sql);

			if(isset($_POST["insertar"])) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
				{
					
					
					$items2		 =($_POST["Nombre_Menu"]);
					$items3		 =($_POST["Descripcion_Menu"]);
					$items4	 	 =($_POST["Precio_Menu"]);
					$items5      =($_FILES["fileimagen"]["name"]);
					$items6      =($_FILES["fileimagen"]["type"]);
					$items7		 =($_FILES["fileimagen"]["tmp_name"]);
					$items8		 =($_POST["Categoria_Menu"]);
					
					
					//Separar valores de arrays,en este caso son 6 arrays uno por cada input
					while(true)
					{
									//recuperar los valores de los arreglos
									$item2=current($items2);
									$item3=current($items3);
									$item4=current($items4);
									$item5=current($items5);
									$item6=current($items6);
									$item7=current($items7);
									$item8=current($items8);
									
								//Asignarlos a variables
								$nombre_Menu		=(($item2 !== false) ? $item2 : ", &nbsp;");
								$descripcion_Menu	=(($item3 !== false) ? $item3 : ", &nbsp;");
								$precio_Menu		=(($item4 !== false) ? $item4 : ", &nbsp;");
								$sNombreArchivo		=(($item5 !== false) ? $item5 : ", &nbsp;");
								$sTipoExtension		=(($item6 !== false) ? $item6 : ", &nbsp;");
								$tmp_name	    	=(($item7 !== false) ? $item7 : ", &nbsp;");
								$categoria_Menu     =(($item8 !== false) ? $item8 : ", &nbsp;");
							//mover archivo de lugar temporal al destino, sistema
								$sPath=$_SERVER["DOCUMENT_ROOT"].'/RESTAURANTE/Imagenes';
								//Con este comando subimos la imagen al servidor
								move_uploaded_file($tmp_name,$sPath."/".$sNombreArchivo);
								//insertar en la base
								$sql="insert into imagenes (NombreArchivo,TipoExtension,Path) value(?,?,?)";
								$cmd= prepare_query($conexion,$sql,[$sNombreArchivo,$sTipoExtension,$sPath]);
								if($cmd)
									{
										//Concatenar los valores en orden para su futura insercion 
										$idImagen= $cmd->insert_id;
										$campos=array($nombre_Menu,$descripcion_Menu,$precio_Menu,$idImagen);
										//sql de insercion de Menu
										$sql="insert into menu(Nombre_Menu,Descripcion_Menu,Precio_Menu,idImagen,Fecha_Menu) values(?,?,?,?,NOW())";
										$datos=prepare_query($conexion,$sql,$campos);
										$idMenu= $datos->insert_id;
								
											if($datos)
												{// insercion a la tabla Menu_categoria												
													//Recupero id de la categoria seleccionada
														$sql="SELECT idCategoria_menu FROM categoria_menu WHERE Nombre_cat_menu=?";
														$cmd=prepare_select($conexion,$sql,[$categoria_Menu]);
														$fila=$cmd->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
														$idCategoria_Menu=$fila['idCategoria_menu'];
														$sql1="insert into producto_categoria (idMenu,idCategoria_Menu) values(?,?)";
														$datos1=prepare_query($conexion,$sql1,[$idMenu,$idCategoria_Menu]);
														
														header("Location: index.php");
														
													}
											else
												{
													$msg ='No se Guardo Error:'.$sql.'</br>'.$cmd->error;	
												}
									}
								//proximo valor
								$item2= next($items2);
								$item3= next($items3);
								$item4= next($items4);
								$item5= next($items5);
								$item6= next($items6);
								$item7= next($items7);
								$item8= next($items8);
								//check terminator
								if( $item2 === false && $item3===false && $item4===false && $item5===false && $item6===false && $item7===false && $item8===false )break;
                    }
                }
			else
				{
					$msg="Ingresa Datos En Los Campos";
				}
		

?>
				
<div class="todo container col-11">
			
						<form class="form-row  mx-auto " id="form"  action="Create.php" method="POST" enctype="multipart/form-data">
						<div class="table-responsive">
						<table class="table bg-light" id="tabla">
									<thead  class="text-center text-white" style="background-color:rgb(108,059,042)" >
										<th colspan="1"><h4><a href="index.php" ><i class="fas fa-list text-white "></i></a></h4></th>
											<th colspan="6" ><h4 class="titulo">Agregar Menu</h4></th>
									</thead >
									<thead  class="text-center" >
											<th>Nombre</th>
											<th>Precio</th>
											<th>Descripcion</th>
											<th>Categoria</th>
											<th>Selc.Imagen</th>
											<th></th>
									</thead >
										<tr class="fila-fija text-center ">		

													<td>
															<!--Nombre del Menu-->
															<div  class = "form-group col-md-" id = "user-group">
																
																<input type="text"  class = "cuadro form-control" required name="Nombre_Menu[]" id="Nombre"/>
															</div>
													</td>
													
													<td>
															<!--Nombre del Precio-->
															<div  class = "form-group " id = "user-group">
																
																<input type="number" class = "cuadro form-control " name="Precio_Menu[]" />
															</div>
													</td>
													<td>
															<!--Nombre del Descripcion-->
															<div   class = "form-group " id = "user-group">
																
																	<input class = "cuadro form-control"  name="Descripcion_Menu[]" > </input>
															</div>
													</td>
													<td>
															<!--Nombre del Categoria-->		
															<div  class = "grd form-group " id = "user-group">
																	<select class = " form-control "  name="Categoria_Menu[]">
																		<?php 
																		foreach($categorias as $fila){?>
																				<option> <?php echo $fila["Nombre_cat_menu"];?> </option>
																		<?php }?>
																	</select>
															</div>
													</td>
													<td>
																<!--img-->	
															
																
																	<input type="file" name="fileimagen[]"  id="fileimagen"   />
																		
																
																
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
<br>
<br>
<br>
<?php require_once('../Libs/footer.php')?>


<?php
		ob_end_flush();
?>					