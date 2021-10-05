<?php
ob_start();
?>
<?php
session_start();
 require_once ('../Libs/header.php');
 require_once('../Libs/MenuAdministrador.php');
?>
<?php
$sql="select Nombre_cat_menu from categoria_menu";
$categorias= prepare_select($conexion,$sql);
    if(!empty($_GET["idMenu"]))
        {
            $idMenu= $_GET["idMenu"];
            $sql="select * from menu  where idMenu=?";
            $datos=prepare_select($conexion,$sql,[$idMenu]);
            if($datos->num_rows>0)
                {
                    $fila=$datos->fetch_assoc();
                }
        }
    else{
            if(!empty($_POST)) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                {
                    $idMenu		=$_POST["idMenu"];
                    $codigo    		 =$_POST["Codigo"];
                    $nombre			 =$_POST["Nombre"];
                    $descripcion	 =$conexion->real_escape_string($_POST["Descripcion"]);
					$precio			 =$_POST["Precio"];
					
                    //imagen
		            $NombreArchivo  =$_FILES["fileimagen"]["name"];
		            $TipoExtension  =$_FILES["fileimagen"]["type"];
		            //mover archivo de lugar temporal al destino, sistema
		            $Path			 =$_SERVER["DOCUMENT_ROOT"].'/RESTAURANTE/Imagenes';
		            //Con este comando subimos la imagen al servidor
					move_uploaded_file($_FILES["fileimagen"]["tmp_name"],$Path."/".$NombreArchivo);
				   	$campos=array($codigo,$nombre,$descripcion,$precio,$NombreArchivo,$TipoExtension,$Path,$idMenu);
					//$sql="update menu set Codigo=?,Nombre=?,Descripcion=?,Precio=?,Stock=?,StockMinimo=? where idmenu=?";
                    $sql="update menu INNER JOIN imagenes ON imagenes.idImagen = menu.idImagen  SET menu.Codigo_Menu =?,menu.Nombre_Menu =?,menu.Descripcion_Menu=?,menu.Precio_Menu=?,imagenes.NombreArchivo=?,imagenes.TipoExtension=?,imagenes.Path=? WHERE idMenu=?";
                    $cmd=prepare_query($conexion,$sql,$campos);
                    
                    if($cmd)
                        { 
							//Recupero id de la categoria seleccionada
							$categoria		 =$_POST["Categoria"];
							$sql1="SELECT idCategoria_Menu FROM categoria_menu WHERE Nombre_cat_menu=?";
							$datos=prepare_select($conexion,$sql1,[$categoria]);
							$fila=$datos->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
							$idCategoria_Menu=$fila['idCategoria_Menu'];
							echo $Categoria;
							$sql="update producto_categoria SET idCategoria_Menu=? WHERE idMenu=?";
							$datos1=prepare_query($conexion,$sql,[$idCategoria_Menu,$idMenu]);
							header("Location: index.php");

						 }
                    else
                        { $msg ='No se Guardo Error:'.$sql.'</br>'.$cmd->error; }
				}
				
        }
?>
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloUpdate.css">
	</head>
<div class="modal-dialog text-center" >
		<div  class= "main-section ">
			<div  class="modal-content">
			<!--TIULO--->
				<div class="titulo  mx-auto text-white col-12 " style="background-color:rgb(108,059,042)"  >		
							<h4 class=" my-2"><a href="index.php" ><i class="lista fas fa-list text-white"></i></a>Modificar Menu</h4>
                </div>
					<form class="form-row col-10 mx-auto m-4" id="form"  action="update.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="idMenu" id="idMenu" value=<?php echo $fila["idMenu"];?>>
							<div  class = "form-group col-md-3" id = "user-group">
									<h5 for="Codigo" class="text-left"> Codigo</h5>
										<h5   name="Codigo" > <?php echo $fila["idMenu"];?></h5>
							</div>	
							<div  class = "form-group col-md-6" id = "user-group">
							<h5 for="Nombre" class="text-left"> Nombre</h5>
										<input type="text" class = "form-control"  name="Nombre" value="<?php echo $fila["Nombre_Menu"];?>" />
							</div>
							<div  class = "form-group col-md-3" id = "user-group">
                                <h5 class="text-left"> Precio</h5>
								<input type="number"  class = "form-control " name="Precio" value="<?php echo $fila["Precio_Menu"];?>" />
							</div>	
							<div   class = "form-group" id = "user-group">
                                <h5 for="Descripcion" class="text-left"> Descripcion</h5>
									<textarea rows="2" cols="100" class = "form-control"  name="Descripcion"  ><?php echo $fila["Descripcion_Menu"];?> </textarea>
							</div>
							<div  class = "grd form-group col-6" id = "user-group">
									<select class = " form-control "  name="Categoria">
											<?php 
												foreach($categorias as $fila){?>
												<option> <?php echo $fila["Nombre_cat_menu"];?> </option>
											<?php }?>
									</select>
							</div>
								<!--img-->
								<div  class = "grd form-group ml-2" id = "user-group">
										<label for="fileimagen" class="subir">
												<i class="fas fa-cloud-upload-alt mr-1"></i>Cambiar Imagen
										</label>
										<input type="file"  name="fileimagen"  id="fileimagen" ochange="cambiar()"  style='display: none;'/>
										<div  id="info"></div>
								</div>
								<button type="submit" class = "btn btn-primary mx-auto col-6" > <i class="fas fa-cloud-upload-alt"></i>  Guardar  </button>
					</form> 
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
    	</div>	
	</div>
<script>
	//botton de file 
	function cambiar(){
			var pdrs = document.getElementById('fileimagen').files[0].name;
			document.getElementById('info').innerHTML = pdrs;
		}
	///////////////
</script>
<?php require_once('../Libs/footer.php');?>

<?php
		ob_end_flush();
?>	