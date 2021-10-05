<?php
session_start();
require_once ('../Libs/header.php');
require_once('../Libs/MenuAdministrador.php');
date_default_timezone_set("America/Buenos_Aires");
?>
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloProveedor.css">
	</head>
<?php

	if(isset($_POST["insertar"])) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
				{
					$items1		 =($_POST["RazonSocial"]);
                    $items2		 =($_POST["Cuit"]);
                    $items3		 =($_POST["Direccion"]);
                    $items4		 =($_POST["Telefono_Fijo"]);
                    $items5		 =($_POST["Area"]);
                    $items6		 =($_POST["Cod_Postal"]);
                    $items7		 =($_POST["Localidad"]);
					//Separar valores de arrays,en este caso son 6 arrays uno por cada input
					while(true)
					{
									//recuperar los valores de los arreglos
									$item1=current($items1);
                                    $item2=current($items2);
                                    $item3=current($items3);
                                    $item4=current($items4);
                                    $item5=current($items5);
                                    $item6=current($items6);
                                    $item7=current($items7);
									//Asignarlos a variables
									$RazonSocial	=(($item1 !== false) ? $item1 : ", &nbsp;");
                                    $Cuit       	=(($item2 !== false) ? $item2 : ", &nbsp;");
                                    $Direccion      =(($item3 !== false) ? $item3 : ", &nbsp;");
                                    $Telefono_Fijo  =(($item4 !== false) ? $item4 : ", &nbsp;");
                                    $Area           =(($item5 !== false) ? $item5 : ", &nbsp;");
                                    $Cod_Postal     =(($item6 !== false) ? $item6 : ", &nbsp;");
                                    $Localidad      =(($item7 !== false) ? $item7 : ", &nbsp;");
                                    $campos=array($RazonSocial,$Cuit,$Direccion,$Telefono_Fijo,$Area,$Cod_Postal,$Localidad);
									$sql="insert into proveedores(RazonSocial,Cuit,Direccion,Telefono_Fijo,Area,Cod_Postal,Localidad) values(?,?,?,?,?,?,?)";
									$datos=prepare_query($conexion,$sql,$campos);
									if($datos)
										{
											$msg1="Provedor Cargado con Exito";
										}
									else
										{
										$msg ='No se Guardo Error:'.$sql.'</br>'.$cmd->error;	
										}
													//proximo valor
													$item1= next($items1);
                                                    $item2= next($items2);
                                                    $item3= next($items3);
                                                    $item4= next($items4);
                                                    $item5= next($items5);
                                                    $item6= next($items6);
                                                    $item7= next($items7);
													//check terminator
													if($item1 === false && $item2===false && $item3===false && $item4===false && $item5===false && $item6===false && $item7===false)break;
									}
								}
							
							else{
								$msg='';
							}

?>
				
<div class="todo container col-11">
			
						<form class="form-row  mx-auto " id="form"  action="Create.php" method="POST" enctype="multipart/form-data">
						<div class="table-responsive">
						<table class="table bg-light" id="tabla">
									<thead  class="text-center text-white" style="background-color:rgb(108,059,042)" >
										<th colspan="1"><a href="index.php" class="titulo1create " ><h4><i class="fas fa-list text-white mr-5"></i></h4></a></th>
											<th colspan="7" ><h4 class="titulo2create">Agregar Proveedor</h4></th>
									</thead >
									<thead  class="text-center" >
                                            <th>Razon Social</th>
                                            <th>Cuit</th>
											<th>Direccion</th>
                                            <th>Telefono Fijo</th>
                                            <th>Area</th>
                                            <th>Cod.Postal</th>
                                            <th>Localidad</th>
                                            <th></th>
									</thead >
										<tr class="fila-fija text-center ">		
													<td>
															<!--RazonSocial del proveedor-->
															<div  class = "form-group col-md-" id = "user-group">
																<input type="text" placeholder = "Razon Social" class = "cuadro form-control" required name="RazonSocial[]" id="RazonSocial"/>
															</div>
													</td>
													<td>
															<!--cuit proveedor-->
															<div   class = "form-group " id = "user-group">
																	<input type="num" class = "cuadro form-control" placeholder = "Cuit" required name="Cuit[]" > </input>
															</div>
													</td>
                                                    <td>
															<!--Direccion proveedor-->
															<div   class = "form-group " id = "user-group">
																	<input type="text" class = "cuadro form-control" placeholder ="Direccion"  name="Direccion[]" > </input>
															</div>
													</td>
                                                    <td>
															<!--Telefono Fijo proveedor-->
															<div   class = "form-group " id = "user-group">
																	<input type="num" class = "cuadro form-control" placeholder ="Telefono Fijo" required name="Telefono_Fijo[]" > </input>
															</div>
													</td>
													<td>
															<!--Area proveedor-->
															<div   class = "form-group " id = "user-group">
																	<input type="text" class = "cuadro form-control" placeholder ="Area" required name="Area[]" > </input>
															</div>
                                                    </td>
                                                    <td>
															<!--cod_postal proveedor-->
															<div   class = "form-group " id = "user-group">
																	<input type="num" class = "cuadro form-control" placeholder ="Cod-Postal" required name="Cod_Postal[]" > </input>
															</div>
													</td>
													<td>
															<!--cod_postal proveedor-->
															<div   class = "form-group " id = "user-group">
																	<input type="num" class = "cuadro form-control" placeholder ="Localidad" required name="Localidad[]" > </input>
															</div>
													</td>
													

														<td class="eliminar ">
															<a type="button" class="  " ><h2><i class="fas fa-times-circle text-danger"></i></h2></a>
													</td>
									</table>
																		</div>
										<div class="btn-der ">
											<input type="submit" name="insertar" value="Insertar Proveedor " class="btn btn-info"/>
											<button id="adicional" name="adicional" type="button" class=" btn btn-success">Mas +</button>
										</div>
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

<script >
	$(function(){
		//clona la fila oculta que tiene los campos bases y lo agrega al final de la tabla
		$("#adicional").on('click', function(){
			$("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
		});
		//Evento que selecciona la fila y la elimina
		$(document).on("click",".eliminar",function(){
			var parent = $(this).parents().get(0);
			$(parent).remove();
		});
	});
</script>
<?php require_once('../Libs/footer.php')?>