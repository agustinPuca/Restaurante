<?php
session_start();
 require_once ('../Libs/header.php');
 require_once('../Libs/MenuAdministrador.php');
?>
<?php
    if(!empty($_GET["idInsumo"]))
        {
            $idinsumo= $_GET["idInsumo"];
            $sql="select * from insumos where idInsumo=?";
            $datos=prepare_select($conexion,$sql,[$idinsumo]);
            if($datos->num_rows>0)
                {
                    $fila=$datos->fetch_assoc();
                }
        }
    else{
            if(!empty($_POST)) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                {
                    $idinsumo=$_POST["idInsumo"];
                    $Codigo_Insumo		 =$_POST["Codigo_Insumo"];
                    $Nombre_Insumo		 =$_POST["Nombre_Insumo"];
                    $Descripcion_Insumo	 =$conexion->real_escape_string($_POST["Descripcion_Insumo"]);
                    
					$campos=array($Nombre_Insumo,$Descripcion_Insumo,$idinsumo);
                    $sql="update insumos SET Nombre_Insumo=?,Descripcion_insumo=? WHERE  idInsumo=?";
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
							<h4 class=" my-2"><a href="IndexInsumo.php" ><i class="lista fas fa-list text-white"></i></a>Modificar Categoria</h4>
                </div>			
					<form class=" col-12 my-2 " id="form"  action="UpdateInsumo.php" method="POST" enctype="multipart/form-data">
                    	<input type="hidden" name="idInsumo" id="idInsumo" value=<?php echo $fila["idInsumo"];?>>	
							
							
                        <div  class = "form-group col-md-" id = "user-group">
                                                            <h6 for="Nombre_Insumo" class="text-center"> Codigo</h6>
																<h4 class = " text-center mr-4"  name="Codigo_Insumo" id="Codigo" ><?php echo $fila["idInsumo"]?></h4>
															</div>
															<!--Nombre_Insumo del Insumo-->
															<div  class = "form-group col-md-" id = "user-group">
                                                            <h6 for="Nombre_Insumo" class="text-left"> Nombre</h6>
																<input type="text"  class = "cuadro form-control" required name="Nombre_Insumo_Insumo" id="Nombre_Insumo" value=<?php echo $fila["Nombre_Insumo"]?>>
															</div>
							
															<!--Nombre_Insumo del Descripcion-->
															<div   class = "form-group " id = "user-group">
                                                            <h6 for="Nombre_Insumo" class="text-left"> Descripcion</h6>
																	<input class = "cuadro form-control"  name="Descripcion_Insumo" value=<?php echo $fila["Descripcion_Insumo"]?>> </input>
															</div>
															<!--Nombre_Insumo del Categoria-->		
                                                            
															
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

