<?php
session_start();
 require_once ('../Libs/header.php');
 require_once('../Libs/MenuAdministrador.php');
?>
<?php
    if(!empty($_GET["idProveedor"]))
        {
            $Proveedor= $_GET["idProveedor"];
            $sql="select * from proveedores where idProveedor=?";
            $datos=prepare_select($conexion,$sql,[$Proveedor]);
            if($datos->num_rows>0)
                {
                    $fila=$datos->fetch_assoc();
                }
        }
    else{
            if(!empty($_POST)) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                {
                    $Proveedor       =$_POST["idProveedor"];
                    $RazonSocial	 =$_POST["RazonSocial"];
                    $Cuit	         =$_POST["Cuit"];
                    $Domicilio	     =$_POST["Domicilio"];
                    $Telefono	     =$_POST["Telefono"];
                    $Area	         =$_POST["Area"];
					$campos=array($RazonSocial,$Cuit,$Domicilio,$Telefono,$Area,$Proveedor);
                    $sql="update Proveedores SET RazonSocial =?,Cuit=?,Direccion=?,Telefono_Fijo=?,Area=? WHERE  idProveedor=?";
                    $cmd=prepare_query($conexion,$sql,$campos);
                    
                    if($cmd)
						{
                            $msg1="Categoria Cargada con Exito:";	
                            require_once('index.php');
                            exit ();  
						}
                    else
                        { $msg ='No se Guardo Error:'.$sql.'</br>'.$cmd->error; }
                }	
        }
?>
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloProveedor.css">
	</head>
<div class="todo modal-dialog text-center" >
		<div  class= "main-section ">
			<div  class="modal-content">
			<!--TIULO--->
			<div class="titulo  mx-auto text-white col-12 " style="background-color:rgb(108,059,042)"  >		
							<h4 class=" my-2"><a href="index.php" ><i class="lista fas fa-list text-white"></i></a>Modificar Proveedor</h4>
                </div>			
					<form class=" col-12 my-2 " id="form"  action="update.php" method="POST" enctype="multipart/form-data">
                    	<input type="hidden" name="idProveedor" id="idProveedor" value=<?php echo $fila["idProveedor"];?>>	
							
							<div  class = "form-group " id = "user-group">
								<h6 for="RazonSocial" class="text-left"> Razon Social</h6>
									<input type="text" class = "form-control"  name="RazonSocial" id="RazonSocial" value=<?php echo $fila["RazonSocial"];?>>
                            </div>	
                            <div  class = "form-group" id = "user-group">
								<h6 for="Cuit" class="text-left"> Cuit</h6>
									<input type="num" class = "form-control"  name="Cuit" id="Cuit" value=<?php echo $fila["Cuit"];?>>
                            </div>
                            <div  class = "form-group" id = "user-group">
								<h6 for="Domicilio" class="text-left">Domicilio</h6>
									<input type="text" class = "form-control"  name="Domicilio" id="Domicilio" value=<?php echo $fila["Direccion"];?>>
                            </div>
                            <div  class = "form-group" id = "user-group">
								<h6 for="Telefono" class="text-left">Telefono</h6>
									<input type="num" class = "form-control"  name="Telefono" id="Telefono" value=<?php echo $fila["Telefono_Fijo"];?>>
                            </div>
                            <div  class = "form-group" id = "user-group">
								<h6 for="Area" class="text-left">Area</h6>
									<input type="text" class = "form-control"  name="Area" id="Area" value=<?php echo $fila["Area"];?>>
                            </div>
							
								<button type="submit" class = "btn btn-primary mx-auto col-6" > <i class="fas fa-cloud-upload-alt"></i>Guardar </button>
					</form> 
					
			</div>
    	</div>	
	</div>
<?php require_once('../Libs/footer.php');?>