<?php
session_start();
require_once ('../Libs/header.php');
require_once('../Libs/MenuAdministrador.php');
date_default_timezone_set("America/Buenos_Aires");
?>
<?php

if(!empty($_POST["btnAceptar"]))
        {
                if(!empty($_POST["Nombre"]) &&  !empty($_POST["Descripcion"]))//dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                    {
                        
                        $nombre			 =$_POST["Nombre"];
                        $descripcion	 = $conexion->real_escape_string($_POST["Descripcion"]);
                        
                        $campos=array($nombre,$descripcion);
                        $sql="insert into categoria_empleado(Nombre_Categoria,Descripcion) values(?,?)";
                        
                        $datos=prepare_query($conexion,$sql,$campos);
                    
                        if($datos)
                            { 
                                    $msg1 ='Categoria Guardada';
                            }
                        else
                            {
                            $msg ='No se Guardo Error:'.$sql.'</br>'.$cmd->error;	
                            }
                    }	
                else{
                      $msg ='Campos Vacios';
                    }
        }
else {
    $msg='';
}

?>
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloCategoria.css">
	</head>
			
			<div class="modal-dialog text-center" >
		<div  class= "col-sm-12 main-section ">
			<div  class="modal-content">
            <div class="titulo  mx-auto text-white col-12" style="background-color:rgb(108,059,042)"  >		
							<h3 class=" my-2"><a href="indexCategoria.php" ><i class="lista fas fa-list text-white"></i></a>Agregar Rol Empleado</h3>
                </div>			
					<form class="col-12 my-2" id="loginform" role="form" action="CategoriaEmpleado.php" method="POST">
						
							
                            
							<div  class = "form-group" id = "user-group">
								<h6 for="Nombre" class="text-left"> Nombre</h6>
									<input type="text" class = "form-control"  name="Nombre" id="Nombre">
                            </div>	
                            
							<div   class = "form-group" id = "user-group">
                                <h6 for="Descripcion" class="text-left"> Descripcion</h6>
									<textarea rows="4" cols="100" class = "form-control"  name="Descripcion" > </textarea>
                            </div>	
							
								<button type="Submit" class = "btn btn-primary" name="btnAceptar" id="btnAceptar" value="Guardar"> <i class="fas fa-cloud-upload-alt"></i>   Cargar  </button>
						
                    </form> 
					 <?php if(!empty($msg)){?>
                        <div class="alert alert-danger my-3" role="alert">
                          <?php echo $msg;?>
                        </div> 
                     <?php }
                     if(!empty($msg1)){ ?>
                     <div class="alert alert-success my-3" role="alert">
                          <?php echo $msg1; ?>
                        </div> 
                     <?php } ?>
			</div>
    	</div>	
	</div>
<?php require_once('../Libs/footer.php')?>