<?php
ob_start();
?>
<?php
session_start();
require_once ('../Libs/header.php');
    if($_SESSION['Nombre_Categoria']=='Mozo'){
        require_once('../Libs/barramozo.php');
    }
    else{
        require_once('../Libs/MenuCajero.php');
    }
date_default_timezone_set("America/Buenos_Aires");
?>
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="csspedido/EstiloPedido.css">
	</head>
<?php
//detalle pedido donde vy a mostrar las listas de producto dependiendo de la categoria
//Selecciono todos los nombres de categoria 
$sql="select Nombre_cat_insumo from categoria_insumo";
$Categorias= prepare_select($conexion,$sql);
$categoria=$_POST['Categoria'];

//recupero idcategoria a partir del nombre
$sql="SELECT idCategoria_Insumo FROM Categoria_insumo WHERE Nombre_cat_insumo=?";
$cmd=prepare_select($conexion,$sql,[$categoria]);
$fila=$cmd->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
$idCategoria=$fila['idCategoria_Insumo'];

if(isset($_POST["SelectCategoria"]))
		{
				$sql="select i.* from Insumos i inner join Categoria_Insumo ci on i.idCategoria_Insumo=ci.idCategoria_Insumo where ci.idCategoria_Insumo=".$idCategoria;
				$Insumos= prepare_select($conexion,$sql);
		}
if(isset($_POST["insertar"])) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
				{

					$items1    	 =($_POST["idInsumo"]);
					$items2		 =($_POST["Cantidad"]);
					$items3		 =($_POST["Descripcion"]);
					//cargo tabla pedido_compra
					$Fecha_Entrega	 =($_POST["Fecha_Entrega"]);
					$Iva	 =($_POST["Iva"]);
					$Proveedor	     =($_POST["Proveedor"]);//nombre del proveedor que elegi
					
					$sql="SELECT idProveedor FROM proveedores WHERE RazonSocial=?";
					$cmd=prepare_select($conexion,$sql,[$Proveedor]);
					$fila=$cmd->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
					$idProveedor=$fila['idProveedor'];
					$campos=array($Fecha_Entrega,$idProveedor,$Iva,'Pendiente');
					$sql="insert into pedido_compra(Fecha_Entrega,idProveedor,Iva,Estado,Fecha_Pedido) values(?,?,?,?,NOW())";
					$datos=prepare_query($conexion,$sql,$campos);
					$idPedido= $datos->insert_id;
					//Separar valores de arrays,en este caso son 6 arrays uno por cada input
					while(true)
					{
									//recuperar los valores de los arreglos
									$item1=current($items1);
									$item2=current($items2);
									$item3=current($items3);
								//Asignarlos a variables
								$idInsumo		=(($item1 !== false) ? $item1 : ", &nbsp;");
								$Cantidad		=(($item2 !== false) ? $item2 : ", &nbsp;");
								$Descripcion	=(($item3 !== false) ? $item3 : ", &nbsp;");
								
								if($datos)
										{   if($Cantidad>0)
											$sql="insert into det_ped_compra(idInsumo,Cantidad,idPedido_Compra,Descripcion,Estado) value(?,?,?,?,'Pendiente')";
											$cmd= prepare_select($conexion,$sql,[$idInsumo,$Cantidad,$idPedido,$Descripcion]);
											header("Location: index_mozo.php");
										}
								//proximo valor
								$item1= next($items1);
								$item2= next($items2);
								$item3= next($items3);
								//check terminator
								if($item1 === false && $item2 === false && $item3 === false)break;
                    }
                }
			else
				{
					$msg="Ingresa Datos En Los Campos";
				}
				$sql="select RazonSocial from proveedores";
				$Proveedores= prepare_select($conexion,$sql);
?>	

									

                                    <div class="form-inline ml-5" id="Numero_Mesa" style="position: absolute; top: 10px; right:30px;" >
                                                                        <h3 class="text-white my-1 mr-3" >Categoria: </h3>   
                                                                        <form class="form-inline " action="CreatePed_mozo.php" method="POST" enctype="multipart/form-data">                                                                          
                                                                            <select class = " form-control   "  name="Categoria">
                                                                                    <?php 
                                                                                        foreach($Categorias as $fila){?>
                                                                                            <option> <?php echo $fila["Nombre_cat_insumo"];?> </option>
                                                                                        <?php }?>
                                                                            </select>
                                                                                <input type="submit" name="SelectCategoria" value="✓" class="btn btn-success ">
                                                                        </form> 
                                                                                
                                        </div> 


<div class="container col-11 my-3 container-responsive">
                                  
		<form class="form-row   " id="form"  action="CreatePed_mozo.php" method="POST" enctype="multipart/form-data">
          <div class="table-responsive"> 
            <?php if(isset($_POST["SelectCategoria"])): ?>
                <input type="submit" name="insertar" value="Terminar Pedido" class="btn btn-success"/>
                <a href="CreatePed_mozo.php" class="btn btn-danger float-right">X Cancelar Pedido</i></a>
             <?php else:?>
                <h4 ><a href="index_mozo.php" class="btn btn-info"><i class="fas fa-list text-white "></i>Lista de Pedidos</i></a></h4>
            <?php endif ?>
                 <nav class="navbar navbar-light justify-content-between  " style="background-color:rgb(108,059,042)">
                                        <h3 class="mx-auto text-white ">Agregar Pedido de compra</h3>		
									</nav>  
            <table class="table bg-light table-sm " id="tabla">
				
													<thead  class="text-center" >
															<th>Fecha Estimada de Entrega</th>
															<th>IVA</th>
															<th>Proveedor</th>
															
													</thead >
														<tr class="fila-fija text-center ">		
																	<td>
																			<!--Fecha_Entrega proveedor-->
																			<div   class = "form-group " id = "user-group">
																					<input type="date" class = "cuadro form-control" placeholder = "Fecha Estimada de Entrega"  name="Fecha_Entrega" > </input>
																			</div>
																	</td>
																	
																	<td>
																			<!--Fecha_Entrega proveedor-->
																			<div   class = "form-group " id = "user-group">
																					<input type="num" min="1" class = "cuadro form-control" placeholder = "Impuesto sobre el valor añadido" name="Iva" > </input>
																			</div>
																	</td>
																	<td>
																	<!--Proveedores-->		
																			<div  class = "grd form-group " id = "user-group">
																					<select class = " form-control "  name="Proveedor">
																						<?php 
																						foreach($Proveedores as $Proveedor){?>
																								<option> <?php echo $Proveedor["RazonSocial"];?> </option>
																						<?php }?>
																					</select>
																			</div>
																	</td>				
													<thead  class="text-center  " style="background-color:rgb(220, 220, 220)" >
															<td colspan="3" ><h5 class="titulo2create">Detalle de Pedido</h5></td>
													</thead >                    
													<thead  class="text-center" >
															<th>Insumo</th>
															<th>Cantidad</th>  
															<th>Descripcion</th>                             
													</thead >
<!----------------------Lista de insumos para pedir----->													
													<?php 
														if(isset($Insumos)){
															foreach($Insumos as $fila){ ?>
																<tr class="fila-fija text-center ">	
																			<td>
																					<!--Prod-->
																					<input type="hidden" name="idInsumo[]" id="idInsumo" value="<?php echo $fila['idInsumo'] ;?>"/>
																					<div   class = "form-group " id = "user-group" name="Nombre[]">
																						<?php echo $fila['Nombre_Insumo'];?>
																					</div>
																			</td>
																			<td>
																					<!--Cantidad-->
																					<div   class = "form-group col-8 " id = "user-group">
																					<input type="number" class = "cuadro form-control  ml-5" name="Cantidad[]" />
																					</div>
																			</td>
																			<td>
																					<!--dESCRIPCION-->
																					<div   class = "form-group col-8 ml-5" id = "user-group">
																					<input type="text" class = "cuadro form-control " name="Descripcion[]" />
																					</div>
																			</td>
																</tr>
													<?php } 
															}
														
													?>
						</table>
				</div>									
												
		</form> 
</div>


<?php
ob_end_flush();
?>