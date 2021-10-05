<?php
ob_start();
?>
<?php
session_start();
 require_once ('../Libs/header.php');
 require_once('../Libs/MenuAdministrador.php');
?>
<?php
    if(!empty($_GET["idCategoria_menu"]))
        {
            $Categoria= $_GET["idCategoria_menu"];
            $sql="select * from categoria_menu where idCategoria_Menu=?";
            $datos=prepare_select($conexion,$sql,[$Categoria]);
            if($datos->num_rows>0)
                {
                    $fila=$datos->fetch_assoc();
                }
        }
    else{
            if(!empty($_POST)) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                {
                    $Categoria=$_POST["idCategoria"];
                    $nombre			 =$_POST["Nombre"];
					$descripcion	 =$conexion->real_escape_string($_POST["Descripcion"]);
					$campos=array($nombre,$descripcion,$Categoria);
                    $sql="update categoria_menu SET Nombre_cat_menu=?,Descripcion_cat_menu=? WHERE  idCategoria_menu=?";
                    $cmd=prepare_query($conexion,$sql,$campos);
                    
                    if($cmd)
						{
							 header('location: index.php'); 
						}
                    else
                        { $msg ='No se Guardo Error:'.$sql.'</br>'.$cmd->error; }
                }	
        }
?>
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloCategoria.css">
	</head>
<div class="modal-dialog text-center" >
		<div  class= "main-section ">
			<div  class="modal-content">
			<!--TIULO--->
			<div class="titulo  mx-auto text-white col-12 " style="background-color:rgb(108,059,042)"  >		
							<h4 class=" my-2"><a href="index.php" ><i class="lista fas fa-list text-white"></i></a>Modificar Producto</h4>
                </div>			
					<form class=" col-12 my-2 " id="form"  action="update.php" method="POST" enctype="multipart/form-data">
                    	<input type="hidden" name="idCategoria" id="idCategoria" value="<?php echo $Categoria;?>">	
							
							<div  class = "form-group" id = "user-group">
								<h6 for="Nombre" class="text-left"> Nombre</h6>
									<input type="text" class = "form-control"  name="Nombre" id="Nombre" value="<?php echo $fila["Nombre_cat_menu"];?>"/>
                            </div>	
                            
							<div   class = "form-group" id = "user-group">
                                <h6 for="Descripcion" class="text-left"> Descripcion</h6>
									<textarea rows="4" cols="100" class = "form-control"  name="Descripcion"  ><?php echo $fila["Descripcion_cat_menu"];?> </textarea>
                            </div>
								<button type="submit" class = "btn btn-primary mx-auto col-6" > <i class="fas fa-cloud-upload-alt"></i>Guardar </button>
					</form> 
					
			</div>
    	</div>	
	</div>
<?php require_once('../Libs/footer.php');?>
<?php
		ob_end_flush();
?>