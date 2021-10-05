<?php
ob_start();
?>
<?php
session_start();
require_once ('../Libs/header.php');
require_once('../Libs/barramozo.php');
date_default_timezone_set("America/Buenos_Aires");
?>
<?php
//muestro todos mis proveedores para poder seleccionar y modificar
    $sql="select * from Proveedores ";
    $Proveedores=prepare_select($conexion,$sql);
?>
<?php
    if(!empty($_GET["idPedido_Compra"]))
        {
            $Pedido_Compra= $_GET["idPedido_Compra"];
            $sql="select * from Pedido_Compra where idPedido_Compra=?";
            $datos=prepare_select($conexion,$sql,[$Pedido_Compra]);
            if($datos->num_rows>0)
                {
                    $fila=$datos->fetch_assoc();
                }
        }
    else{
            if(!empty($_POST)) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                {
                    $Pedido_Compra=$_POST["idPedido_Compra"];
                    $Razon_Proveedor=$_POST["Proveedor"];
                    //recupero id del proveedor desde su razon_Social
                        $sql="select * from Proveedores where RazonSocial=? ";
                        $cmd=prepare_select($conexion,$sql,[$Razon_Proveedor]);
                        $filas=$cmd->fetch_assoc();
                        $Prov=$filas['idProveedor'];
                        $IVA			 =$_POST["IVA"];
					$campos=array($IVA,$Prov,$Pedido_Compra);
                    $sql="update pedido_compra SET Iva=?, idProveedor=? WHERE  idPedido_Compra=?";
                    $cmd=prepare_query($conexion,$sql,$campos);
                    
                    if($cmd)
						{
							 header('location: index_mozo.php'); 
						}
                    else
                        { $msg ='No se Guardo Error:'.$sql.'</br>'.$cmd->error; }
                }	
        }
?>

<div class="modal-dialog text-center" >
		<div  class= "main-section ">
			<div  class="modal-content">
			<!--TIULO--->
			<div class=" mx-auto text-white col-12 " style="background-color:rgb(108,059,042)"  >		
							<h4 class=" my-2"><a href="index_mozo.php" ><i class="lista fas fa-list text-white float-left"></i></a>Modificar Producto</h4>
                </div>			
					<form class=" col-12 my-2 " id="form"  action="update.php" method="POST" enctype="multipart/form-data">
                    	<input type="hidden" name="idPedido_Compra" id="idPedido_Compra" value="<?php echo $Pedido_Compra;?>">	
                             <!--Muestro el numero del pedido-->
                            <h5 name="idPedido" id="idPedido" >Pedido N° <?php echo $Pedido_Compra;?></h5>	
                            <!--Modifico el iva-->
                            <div  class = "form-group" id = "user-group">
								<h6 for="IVA" class="text-left"> IVA</h6>
									<input type="text" class = "form-control"  name="IVA" id="IVA" value="<?php echo $fila["Iva"];?>"/>
                            </div>
                            <!--Modifico el proveedor-->
                            <select class = " form-control "  name="Proveedor">
									<?php foreach($Proveedores as $Proveedor){?>
												<option> <?php echo $Proveedor["RazonSocial"];?> </option>
									<?php }?>
                            </select>	
                            <br>
                            
								<button type="submit" class = "btn btn-primary mx-auto col-6" > <i class="fas fa-cloud-upload-alt"></i>Guardar </button>
					</form> 
					
			</div>
    	</div>	
	</div>

<?php
		ob_end_flush();
?>