<?php
session_start();
require_once ('../Libs/header.php');
require_once('../Libs/Menu.php');
date_default_timezone_set("America/Buenos_Aires");
?>
<?php
// selecciono lo que hay en la tabla categorias para mostrar en el formulario
$sql="select Nombre from categorias";
$categorias= prepare_select($conexion,$sql);
if(!empty($_POST["btnAceptar"]))
		{
			if(!empty($_POST["Codigo"])) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
				{
					
					//imagen
					$sNombreArchivo  =$_FILES["fileimagen"]["name"];
					$sTipoExtension  =$_FILES["fileimagen"]["type"];
					//mover archivo de lugar temporal al destino, sistema
					$sPath			 =$_SERVER["DOCUMENT_ROOT"].'/RESTAURANTE/Imagenes';
					//Con este comando subimos la imagen al servidor
					move_uploaded_file($_FILES["fileimagen"]["tmp_name"],$sPath."/".$sNombreArchivo);
					//insertar en la base
					$sql="insert into imagenes (NombreArchivo,TipoExtension,Path) value(?,?,?)";
					$cmd= prepare_query($conexion,$sql,[$sNombreArchivo,$sTipoExtension,$sPath]);
					
					if($cmd)
							{
								$codigo    		 =$_POST["Codigo"];
								$nombre			 =$_POST["Nombre"];
								$descripcion	 = $conexion->real_escape_string($_POST["Descripcion"]);
								$precio	 		 =$_POST["Precio"];
								$stock	 		 =$_POST["Stock"];
								$stockminimo     =$_POST["Stockminimo"];
								$categoria=$_POST["Categoria"];
								$idImagen= $cmd->insert_id;
								$campos=array($codigo,$nombre,$descripcion,$stock,$stockminimo,$precio,$idImagen);
								
								$sql="insert into productos(Codigo,Nombre,Descripcion,Stock,Stockminimo,Precio,idImagen,Fecha) values(?,?,?,?,?,?,?,NOW())";
								$datos=prepare_query($conexion,$sql,$campos);
								$idProducto= $datos->insert_id;
								
									if($datos)
										{
											$categoria=$_POST["Categoria"];
											//Recupero id de la categoria seleccionada
												$sql="SELECT idCategoria FROM Categorias WHERE Nombre=?";
												$cmd=prepare_select($conexion,$sql,[$categoria]);
												$fila=$cmd->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
												$idCategoria=$fila['idCategoria'];
												$sql1="insert into producto_categoria (idProducto,idCategoria) values(?,?)";
												$datos1=prepare_query($conexion,$sql1,[$idProducto,$idCategoria]);
												$msg1="Categoria Cargada con Exito";										}
									else
										{
											$msg ='No se Guardo Error:'.$sql.'</br>'.$cmd->error;	
										}
							}
							
				}	
			else
				{
					$msg="Ingresa Datos En Los Campos";
				}
		}
else{
		$msg='';
		}
?>
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/create.css">
</head>

		
				
<div class="todo container col-11">
	 				<!--TIULO--->
	 				<div class="titulo card form-group  "  >
					 					<a href="index.php" > <i class="fas fa-list my-2 "></i></a>
									 	<h5 class="textitulo card-title mx-auto">Agregar Producto</h5>
					</div>
				<div  class= " main-section my-1">
			<div  class="modal-content">
						<form class="form-row col-11 mx-auto my-1" id="form"  action="Create.php" method="POST" enctype="multipart/form-data">
						<!--Codigo del Producto-->
										
										<div  class = "form-group col-md-1" id = "user-group">
												<h6 for="Codigo" class="text-left"> Codigo</h6>
													<input type="text" class = "cuadro form-control "  name="Codigo" id="Codigo"/>
										</div>
										
						<!--Nombre del Producto-->
								<div  class = "form-group col-md-3 ml-2" id = "user-group">
											<h6 for="Nombre" class="text-left"> Nombre</h6>
											<input type="text" class = "cuadro form-control"  name="Nombre" id="Nombre"/>
								</div>
						<!--Nombre del Precio-->
								<div  class = "form-group col-md-2 ml-2" id = "user-group">
									<h6 class="text-left"> Precio</h6>
									<input type="number" class = "cuadro form-control " name="Precio" />
								</div>
							
						<!--<div  class = "form-group  col-md-3 ml-2" id = "user-group">
							<h5 for="Stock" class="text-left"> Stock</h5>
								<input type="number" class = "form-control " name="Stock" id="Stock">
							
							<h5 for="Stockminimo" class="text-left"> Stock Minimo</h5>
								<input type="number" class = "form-control "  name="Stockminimo" id="Stockminimo">
						</div>-->
						<!--Nombre del Descripcion-->
								<div   class = "form-group col-5" id = "user-group">
									<h6 for="Descripcion" class="text-left"> Descripcion</h6>
										<input class = "cuadro form-control"  name="Descripcion" > </input>
								</div>
						<!--Nombre del Categoria-->		
						<div  class = "grd form-group col-md-2" id = "user-group">
							<h6 class="text-left"> Categoria</h6>
								<select class = " form-control "  name="Categoria">
								<?php 
								foreach($categorias as $fila){?>
								
										<option> <?php echo $fila["Nombre"];?> </option>
	
								<?php }?>
							</select>
								
						</div>
						<!--Nombre del Categoria-->
						<div  class = "grd form-group " >
							<h6 for="fileimagen" class="text-left"> Imagen</h6>
							<div  class = "  form-control col-md-12 " id = "user-group">
								<input type="file"   name="fileimagen" id="fileimagen" />
							</div>
						</div>
								<?php if(!empty($msg)){?>
									<div class="alert alert-danger my-3 text-center" role="alert">
									<?php echo $msg;?>
									</div> 
								<?php }
								if(!empty($msg1)){?>
								<div class="alert alert-success my-3 text-center" role="alert">
									<?php echo $msg1;?>
									</div> 
								<?php }?>
							<button type="submit" class = "btn btn-primary mx-auto " name="btnAceptar" id="btnAceptar" value="Guardar"> <i class="fas fa-cloud-upload-alt"></i> Cargar </button>
							<br>
							<a  href="index.php" class="my-2" >Volver a la Lista de Productos</a>
				</form> 
                              
		</div>      
	</div>
</div>
<?php require_once('../Libs/footer.php')?>