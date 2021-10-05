<?php
session_start();
 require_once ('../Libs/header.php');
 require_once('../Libs/MenuAdministrador.php');
?>
<?php
    if(!empty($_GET["idCategoria_Insumo"]))
        {
            $catgoria_insumo= $_GET["idCategoria_Insumo"];
            $sql="select * from categoria_insumo where idCategoria_Insumo=?";
            $datos=prepare_select($conexion,$sql,[$catgoria_insumo]);
            if($datos->num_rows>0)
                {
                    $fila=$datos->fetch_assoc();
                }
        }
    else{
            if(!empty($_POST)) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                {
                    $catgoria_insumo=$_POST["idCategoria_Insumo"];
                    $nombre			 =$_POST["Nombre"];
					$descripcion	 =$conexion->real_escape_string($_POST["Descripcion"]);
					$campos=array($nombre,$descripcion,$catgoria_insumo);
                    $sql="update categoria_insumo SET Nombre_cat_insumo =?,Descripcion_cat_inssumo=? WHERE  idCategoria_Insumo=?";
                    $cmd=prepare_query($conexion,$sql,$campos);
                    
                    if($cmd)
						{
							$msg1 ='Modificado Con Exito';
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
							<h4 class=" my-2"><a href="1IndexCat.php" ><i class="lista fas fa-list text-white"></i></a>Modificar Categoria</h4>
                </div>			
					<form class=" col-12 my-2 " id="form"  action="1UpdateCat.php" method="POST" enctype="multipart/form-data">
                    	<input type="hidden" name="idCategoria_Insumo" id="idCategoria_Insumo" value="<?php echo $fila["idCategoria_Insumo"];?>"/>	
							
							<div  class = "form-group" id = "user-group">
								<h6 for="Nombre" class="text-left"> Nombre</h6>
									<input type="text" class = "form-control"  name="Nombre" id="Nombre" value="<?php echo $fila["Nombre_cat_insumo"];?>"/>
                            </div>	
                            
							<div   class = "form-group" id = "user-group">
                                <h6 for="Descripcion" class="text-left"> Descripcion</h6>
									<textarea rows="4" cols="100" class = "form-control"  name="Descripcion"  ><?php echo $fila["Descripcion_cat_inssumo"];?> </textarea>
                            </div>
								<button type="submit" class = "btn btn-primary mx-auto col-6" > <i class="fas fa-cloud-upload-alt"></i>Guardar </button>
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
<?php require_once('../Libs/footer.php');?>