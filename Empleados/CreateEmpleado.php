
<?php
ob_start();
?>
<?php 
session_start();
require_once('../Libs/Header.php');
require_once('../Libs/MenuAdministrador.php');
date_default_timezone_set("America/Buenos_Aires");
?>
<?php
$sql="select Nombre_Categoria from categoria_empleado";
$categorias= prepare_select($conexion,$sql);
if(!empty($_POST["btnAceptar"]))
    {
            if(!empty($_POST["nUsuario"]) )//dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                {
					$nombre		 =$_POST["name1"];
                    $apellido	 =$_POST["name2"];
                    $empleado    =$_POST["nUsuario"];
                    $contraseña  =$_POST["nContraseña"];
                    $fecha_nac   =$_POST["nFN"];
                    $email	 	 =$_POST["E-mail"];
                    $domicilio   =$_POST["txtDomicilio"];
					$dni		 =$_POST["nDNI"];
					$edad        =$_POST["nResultadofn"];
                    $categoria=$_POST["Categoria"];
								//Recupero id de la categoria seleccionada
									$sql="SELECT idCategoria FROM categoria_empleado WHERE Nombre_Categoria=?";
									$cmd=prepare_select($conexion,$sql,[$categoria]);
									$fila=$cmd->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
                                    $idCategoria_Empleado=$fila['idCategoria'];
                                   
                    $campos=array($empleado,$contraseña,$nombre,$apellido,$email,$idCategoria_Empleado,$domicilio,$dni,$fecha_nac,$edad);
                    $sql="insert into empleados(Login,Clave,Nombre,Apellido,Email,idCategoria,Domicilio,DNI,Fecha_Nac,Edad,Fecha_Alta) values(?,?,?,?,?,?,?,?,?,?,NOW())";
                    
                    $datos=prepare_query($conexion,$sql,$campos);
                    if($datos)
                        {
                        header("Location: index.php");
                        exit();
                        }
                    else
                        {
                        $msg="Error al cagar Usuario:";	
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
                                <input type="text" class = " form-control " placeholder = " Nombre " required name="name1" id="Nname1" onblur="TodasMayusculas(this)" />
                                <div class="text-danger" id="iResultadoname1"></div>
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
								<input type="date" class = " form-control " placeholder = " Fecha de Nacimiento " name="nFN" id="iFN" onblur="edad(this)"/>
                            </div>

                            <div  class ="form-group col-5 " id = "user-group">
                                <input class = " form-control text-center" style="border: 0;"  placeholder = " Edad" name="nResultadofn" id="iResultadofn" value=""></input>
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

						 <script>
    //En esta funcion Condiciono solo letras y todo mayuscula en los campos nombre y apellido
        function TodasMayusculas(letras)
            {
                
                        if(/[^a-zA-Z]/.test(letras.value))
                            {
                                document.getElementById("iResultado" + letras.name).innerHTML ="solo letras";
                                document.getElementById("N" + letras.name).style.border="2px solid #c00";
                            }
                            
                         else 
                             {
                                letras.value = letras.value.toUpperCase();//método devuelve el valor convertido en mayúsculas de la cadena que realiza la llamada
                                document.getElementById("N" + letras.name).style.border="2px solid #00bb2d";
                                document.getElementById("iResultado" + letras.name).innerHTML="";
                             }     
                    
            }
        function condicioncontraseña()
        {
            var c=document.getElementById("iContraseña")
                cant=c.value.length;
                    if (cant<5)
                            {
                             document.getElementById("iResultadoContraseña").innerHTML="mayor a 5 caracteres";
                             document.getElementById("iContraseña").style.border="2px solid #c00";
                            }
                    else
                            {
                             document.getElementById("iResultadoContraseña").innerHTML="";
                             document.getElementById("iContraseña").style.border="2px solid #00bb2d";
                            }
        }
        //En esta funcion Condiciono solo numero y no mas de 8 caracteres en el campo dni
        function condiciondni()
            {
                var c=document.getElementById("iDNI")
                cant=c.value.length;
                if(c.value != '')
                    {
                        if(/^[0-9.]+$/.test(c.value))//recorro array para identificae si contiene letra
                        
                                {
                                    if (cant<=8)
                                        {
                                            document.getElementById("iResultadodni").innerHTML="";
                                            document.getElementById("iDNI").style.border="2px solid #00bb2d";
                                            
                                        }
                                    else
                                        {
                                            document.getElementById("iResultadodni").innerHTML="<div class=text-danger>8 caracteres max</div>";
                                            document.getElementById("iDNI").style.border="2px solid #c00";
                                        }
                                }
                            else 
                                {
                                    document.getElementById("iResultadodni").innerHTML="<div class=text-danger>solo numeros en este campo</div>";
                                    document.getElementById("iDNI").style.border="2px solid #c00";
                                }	
                    }
                 else 
                        {
                                    document.getElementById("iResultadodni").innerHTML="";
                                    document.getElementById("iDNI").style.border="2px solid #00bb2d";
                         }
            }
        //En esta funcion establesco la edad basandome en la fecha de nacimiento 
        function edad()
            {
                var c=document.getElementById("iFN")
                f=c.value;
                  x = f.split("-");
                  año=x[0];
                  mes=x[1];
                  dia=x[2];
                  //fecha actual
                  var Factual = new Date();
					  dia_actual= Factual.getDate();
					  mes_actual= Factual.getMonth();
					  año_actual= Factual.getFullYear();
				
					  dia_edad= dia_actual - dia;
					  mes_edad= mes_actual - mes;
					  año_edad= año_actual - año;
			        //sacar la edad								
							if (mes_edad <=0 && dia_edad <0)
								{ if (año_edad>0)
										{
										año_edad--;
										document.getElementById("iResultadofn").value=año_edad + " años";
                                        var edad=document.getElementById("iResultadofn").innerHTML;
                                            
										}
									else
									{
										document.getElementById("iResultadofn").innerHTML="No Nacio";
									}
									
								}
							else
								{  if (año_edad<0)
									{
										document.getElementById("iResultadofn").innerHTML="No Nacio";
									}
								 else
										{
                                            document.getElementById("iResultadofn").value=año_edad + " años";
                                            var edad=document.getElementById("iResultadofn").innerHTML;

										}
										
                                    }
                                    
                                  
            }
            
</script>
<?php require_once('../Libs/footer.php');?>
<?php
ob_end_flush();
?>