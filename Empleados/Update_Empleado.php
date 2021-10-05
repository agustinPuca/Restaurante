<?php
ob_start();
?>
<?php
   session_start();
   require_once('../Libs/header.php');
   require_once('../Libs/MenuAdministrador.php');
?>
<?php
 $sql="select * from Categoria_Empleado ";
           $categorias=prepare_select($conexion,$sql);
?>
<?php
    if(!empty($_GET["idEmpleado"]))
        {
           $idEmpleado=$_GET["idEmpleado"];
           $sql="select * from empleados where idEmpleado=?";
           $datos=prepare_select($conexion,$sql,[$idEmpleado]);
           if($datos->num_rows>0)
           {
               $fila=$datos->fetch_assoc();
           }
        }
        if(!empty($_POST))
        {
               $idEmpleado=$_POST["idEmpleado"];
               $Nombre		 =$_POST["name1"];
               $Apellido	 =$_POST["name2"];
               $Login   =$_POST["nUsuario"];
               $Clave  =$_POST["nContraseña"];
               $Fecha_Nac   =$_POST["nFN"];
               $Email	 	 =$_POST["E-mail"];
               $Domicilio   =$_POST["txtDomicilio"];
               $DNI		 =$_POST["nDNI"];
               $Edad        =$_POST["nResultadofn"];
               $Categoria=$_POST["Categoria"];
                  //Recupero idcategoria a partir del nombre de la categoria seleccionada
                     $sql="SELECT idCategoria from categoria_empleado where Nombre_Categoria=?";
                     $cmd=prepare_select($conexion,$sql,[$Categoria]);
                     $fila=$cmd->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
				   $idCategoria=$fila['idCategoria'];
               $sql="update empleados SET Nombre=?,Apellido=?,DNI=?,Email=?,idCategoria=?,Login=?,Clave=?,Domicilio=?,Fecha_Nac=?,Edad=? WHERE idEmpleado=?";
					$datos1=prepare_query($conexion,$sql,[$Nombre,$Apellido,$DNI,$Email,$idCategoria,$Login,$Clave,$Domicilio,$Fecha_Nac,$Edad,$idEmpleado]);
               if($datos1){
                  header("Location: index.php");
                  exit();
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
    <form class="form-row col-12 my-3" id="Update_Empleado" action="Update_Empleado.php" method="POST">
    <input type="hidden" name="idEmpleado" id="idEmpleado" value=<?php echo $fila["idEmpleado"];?>>
 
                    <div  class = "form-group col-6  " id = "user-group">
                        <input type="text" class = " form-control " placeholder = " Nombre " required name="name1" id="Nname1"  onblur="TodasMayusculas(this)" value="<? echo $fila['Nombre'];?>" />
                        <div class="text-danger" id="iResultadoname1"></div>
                    </div>

                    <div  class = "form-group col-6  " id = "user-group">
                        <input type="text" class = " form-control " placeholder = " Apellido " name="name2" id="Nname2" onblur="TodasMayusculas(this)" value="<? echo $fila['Apellido'];?>"/>
                        <div class="text-danger" id="iResultadoname2"></div>
                    </div>

             <div  class = "form-group col-6 " id = "user-group">
                <input type="text" class = " form-control " placeholder = " Nombre de Usuario " required name="nUsuario" id="iUsuario" value="<? echo $fila['Login'];?>" />
                    </div>

             <div  class = "form-group col-6  " id = "user-group">
                <input type="text" class = " form-control " placeholder = "Contraseña "  name="nContraseña" id="iContraseña" onblur="condicioncontraseña(this)" value="<? echo $fila['Clave'];?>"/>
                        <div class="text-danger" name="nResultadoContraseña" id="iResultadoContraseña"></div>
                    </div>
                       
                    <div  class ="form-group col-6 " id = "user-group">
                <input type="date" class = " form-control " placeholder = " Fecha de Nacimiento " name="nFN" id="iFN" onblur="edad(this)" value="<? echo $fila['Fecha_Nac'];?>" />
                    </div>

                    <div  class ="form-group col-5 " id = "user-group">
                        <input class = " form-control text-center" style="border: 0;"  placeholder = " Edad" name="nResultadofn" id="iResultadofn" value="<? echo $fila['Edad'].' Años';?>"></input>
                    </div>

                <div  class = "form-group col-7 " id = "user-group">
                <input type="text" class = " form-control " placeholder = " Domicilio " name="txtDomicilio" id="txtDomicilio" value="<? echo $fila['Domicilio'];?>"/>
                    </div>
                    
                    <div  class ="form-group col-5 " id = "user-group">
                <input type="text" class = " form-control " placeholder = " DNI " name="nDNI" id="iDNI" onblur="condiciondni(this)" value="<? echo $fila['DNI'];?>"/>
                        <div  name="nResultadodni" id="iResultadodni"></div>
                    </div>

                    <div  class ="form-group col-12 " id = "user-group">
                <input type="text" class = " form-control " placeholder = "E-mail " name="E-mail" id="E-mail" onblur="condiciondni(this)" value="<? echo $fila['Email'];?>"/>
             </div>
             <div  class = "form-group col-md-12" id = "user-group">
                   <select class = "form-control " name="Categoria" >
                   <?php 
                   foreach($categorias as $fila){?>
                   
                         <option> <?php echo $fila["Nombre_Categoria"]; ?> </option>

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
<?php
ob_end_flush();
?>