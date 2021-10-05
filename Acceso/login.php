<?php 
session_start();
require_once('../Libs/Header.php');
?>
<?php
	
	if(!empty($_POST))//dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
		{
			//variable del form html
				$empleado=$conexion->real_escape_string($_POST["txtusuario"]);
				$contraseña=$conexion->real_escape_string($_POST["txtcontraseña"]);	
			$sql="SELECT e.*, ce.Nombre_Categoria from empleados e inner join Categoria_Empleado ce on e.idCategoria=ce.idCategoria where e.Login=?";
			$datos= prepare_select($conexion,$sql,[$empleado]);
				if($datos->num_rows>0)//rows:Obtiene el número de filas de un resultado
					{
					$fila=$datos->fetch_assoc();//fect_array: Obtiene una fila de resultados como un array asociativo, numérico, o ambos
						if($contraseña==$fila["Clave"])
							{
								$_SESSION['idEmpleado']=$fila['idEmpleado'];
								$_SESSION['Login']=$fila['Login'];
								$_SESSION['isAdmin']=1;
								$_SESSION['Nombre']=$fila['Nombre'];
								$_SESSION['Apellido']=$fila['Apellido'];
								$_SESSION['idCategoria']=$fila['idCategoria'];
								$_SESSION['Nombre_Categoria']=$fila['Nombre_Categoria'];
								//Recupero nombre de la categoria seleccionada
								$Nombre_Cat=$_SESSION['Nombre_Categoria'];
								
								if($Nombre_Cat=='Administrador') 
									{
										header("location: ../Style/indexAdministrador.php");
									}
								if($Nombre_Cat=='Mozo') 
									{
										header("location: ../Style/indexMozo.php");
									}
								if($Nombre_Cat=='Cajero') 
									{
										header("location: ../Style/indexCajero.php");
									}
							 }
						else
							{$msg="Contraseña Incorrecta"; }
					}
				else
					{ $msg= "Usuario Incorrecto"; }
		}

	if(isset($_SESSION["idEmpleado"]))//Comprobar si una variable está definida
		{
			 if ($Nombre_Cat== Mozo)
			 	{
				header("location: ../Style/indexMozo.php");
				}
			if ($Nombre_Cat== Administrador)
				{
				header("location: ../Style/indexAdministrador.php");
				}
			if ($Nombre_Cat== Cajero){
				header("location: ../Style/indexCajero.php");
				}
		}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inicio de sesion</title>
    <link rel="stylesheet" href="css/Estilologin.css">
    
  </head>
  <body>
  <div class="modal-dialog text-center" >
		<div  class= "col-sm-8 main-section ">
			<div  class="modal-content">
					<div  class = "col-12 user-img">
            <img class="avatar" src="../Imagenes/logorest.png" > 
             </div> 
            
                    <form class="col-12" id="loginform" action="login.php" method="POST">
                      <!-- USERNAME INPUT -->

                      
                      <div  class = "form-group" id = "user-group">
                              <input type="text"  class = " form-control " placeholder = "Ingrese Usuario " name="txtusuario" />
                          </div>
                      <!-- PASSWORD INPUT -->

                      
                      <div class = "form-group" id = "contraseña-group">
                              <input type="password" class = " form-control " placeholder = " Contraseña "name="txtcontraseña" />
                          </div>
                      <button type="submit" class = "boton"><i  class = " fas fa-sign-in-alt mr-2" > </i >Iniciar sesión</button>
                    
                    </form>
                          <?php if(!empty($msg)):?>
                              <div class="alert alert-danger my-3" role="alert">
                                <?php echo $msg;?>
                              </div> 
                          <?php endif;?>
                          <div  class = " col-12 forgot " >
                   		 	<a  href = "#">Solicitar contraseña </a >
						</div >
          </div>
		  </div>	
	</div>
    
  </body>
</html>