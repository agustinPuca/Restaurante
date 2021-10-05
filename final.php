<?php
	function prepare_query($conexion,$sql,$campo,$tipo="")
		{
			$tipo=$tipo ?: str_repeat('s',count($campo));//repeat repite el valor las vezes q indique
			$cmd=$conexion->prepare($sql);//Prepara la consulta SQL y devuelve un manejador de sentencia para ser utilizado por operaciones adicionales sobre la sentencia.
			if($campo!=[])//si la variable tiene valores
			$cmd->bind_param($tipo, ...$campo); // Agrega variables a una sentencia preparada como parámetros
			$cmd->execute();
			return $cmd;
		}
?>
<?php 
session_start();
date_default_timezone_set("America/Buenos_Aires");
?>
<?php

if(!empty($_POST["btnAceptar"]))
    {
            if(!empty($_POST["nUsuario"]) )//dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                {
                    $IdCliente=$_POST["IdCliente"];
					$Nombre		 =$_POST["Nombre"];
					$DNI		 =$_POST["DNI"];
					$direccion        =$_POST["direccion"];
                    
                    $sql="insert into empleados(Nombre,DNI,direccion) values(?,?,?)";
                    $datos=prepare_query($conexion,$sql,[$Nombre,$DNI,$direccion]);
                }	
                else
                        {
                            $msg="Ingresa Datos En Los Campos";
                        }
    }

?>
	<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/Estilocreate.css">
	</head>

<div class="modal-dialog text-center " >
		<div  class= " main-section ">
			
			<div  class="modal-content">		
				<div class="titulo  mx-auto text-white col-12" style="background-color:rgb(108,059,042)"  >		
							<h2 class=" my-2"><a href="index.php" ><i class="lista fas fa-list text-white"></i></a>Alta de Empleado</h2>
                </div>
				<form class="form-row col-12 my-3" id="loginform" action="CreateEmpleado.php" method="POST">
                            
                            <div  class = "form-group col-6  " id = "user-group">
                                <input type="text" class = " form-control " placeholder = " Nombre " required name="Nombre" id="NNombre" onblur="TodasMayusculas(this)" />
                                <div class="text-danger" id="iResultadoNombre"></div>
                            </div>

                            <div  class = "form-group col-6  " id = "user-group">
                                <input type="text" class = " form-control " placeholder = " Apellido " name="name2" id="Nname2" onblur="TodasMayusculas(this)"/>
                                <div class="text-danger" id="iResultadoname2"></div>
                            </div>

							<div  class = "form-group col-6 " id = "user-group">
								<input type="text" class = " form-control " placeholder = " Nombre de Usuario " required name="nUsuario" id="iUsuario"/>
                            </div>

							<div  class = "form-group col-6  " id = "user-group">
								<input type="password" class = " form-control " placeholder = "Contraseña "  name="nContraseña" id="iContraseña" onblur="condicioncontraseña(this)" />
                                <div class="text-danger" name="nResultadoContraseña" id="iResultadoContraseña"></div>
                            </div>
                            	
                            <div  class ="form-group col-6 " id = "user-group">
								<input type="date" class = " form-control " placeholder = " Fecha de Nacimiento " name="nFN" id="iFN" onblur="Direccion(this)"/>
                            </div>

                            <div  class ="form-group col-5 " id = "user-group">
                                <input class = " form-control text-center" style="border: 0;"  placeholder = " Direccion" name="Direccion" id="iResultadofn" value=""></input>
                            </div>

								<div  class = "form-group col-7 " id = "user-group">
								<input type="text" class = " form-control " placeholder = " Domicilio " name="txtDomicilio" id="txtDomicilio"/>
                            </div>
                            
                            <div  class ="form-group col-5 " id = "user-group">
								<input type="text" class = " form-control " placeholder = " DNI " name="nDNI" id="iDNI" onblur="condiciondni(this)"/>
                                <div  name="nResultadodni" id="iResultadodni"></div>
                            </div>

                            <div  class ="form-group col-12 " id = "user-group">
								<input type="text" class = " form-control " placeholder = "E-mail " name="E-mail" id="E-mail" onblur="condiciondni(this)"/>
							</div>
							<div  class = "form-group col-md-12" id = "user-group">
									<select class = "form-control " name="Categoria">
									<?php 
									foreach($categorias as $fila){?>
									
											<option> <?php echo $fila["Nombre_Categoria"];?> </option>
		
									<?php }?>
								</select>
									
							</div>

							
								<button type="submit" class = " btn btn-primary mx-auto" name="btnAceptar" id="btnAceptar" value="Guardar" style="width:70%;">    Cargar  </button>
                            
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
