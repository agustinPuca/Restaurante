												
 <?php
session_start();
require_once ('../Libs/header.php');
require_once('../Libs/MenuAdministrador.php');
date_default_timezone_set("America/Buenos_Aires");
?>
<head>
			<!-- css-->
      <link rel="stylesheet" type="text/css" href="csspedido/EstiloPedido.css">
      
</head>
  
  <?php
  if(isset($_GET))
      {
        $idPedido_Compra= $_GET['idPedido_Compra'];
		  $sql="select pc.*, i.Nombre_insumo,i.idInsumo,dp.Cantidad,ci.Nombre_Cat_Insumo from  pedido_compra pc inner join det_ped_compra dp on pc.idPedido_Compra=dp.idPedido_Compra inner join Insumos i on i.idInsumo=dp.idInsumo inner join Categoria_Insumo ci on i.idCategoria_Insumo=ci.idCategoria_Insumo where pc.idPedido_Compra=".$idPedido_Compra;
          $Pedidos= prepare_select($conexion,$sql);
		  if($Pedidos->num_rows>0)
		  {
			  $fila=$Pedidos->fetch_assoc();
		  }
		}
		else{
            if(!empty($_POST)) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                {
                    $Categoria=$_POST["idPedido_Compra"];
                }	
        }
    ?>
 <!--Tabla de Insumos-->
 <div class="todo col-11 mx-auto ">
 <nav class="navbar navbar-light justify-content-between" style="background-color:rgb(108,059,042)">
											<h4><a href="index.php"><i class="fas fa-list text-white "></i></a></h4>
											<h3 class="text-center text-white ml-5">Detalle de Pedido de <?php echo $fila['Nombre_Cat_Insumo']?></h3>
											
											<form class="form-inline " action="Detalle.php" method="POST" enctype="multipart/form-data">
													<input type="hidden" name="idPedido_Compra" id="idPedido_Compra" value=<?php echo $fila['idPedido_Compra'];?>>	
													<h2><a type="button" name="imprimir"  onclick="window.print();"><i class="fas fa-print text-white mr-4"></i></a></h2>
													<h2><a href="Pdf.php?idPedido_Compra=<?php echo $fila['idPedido_Compra'];?>" ><i class="fa fa-download text-white mr-3"></i></a></h2>
                     						</form>
									</nav>
				<div class=" text-center">
				<div class="table-responsive">	
				<table class="table  bg-light "  >
                    
							<?php 
							echo '<th></th>';
                            echo '<th>Insumos</th>';
							echo '<th>Cantidad</th>';
							echo '<th>Estado</th>';
                            ?>
                    
						<tbody>
							<?php 
									foreach($Pedidos as $fila)
								{
										echo '<tr>';
										echo '<td style="white-space: nowrap;width: 1%;" ><div class="p-1 "><a href="../Insumos/delete.php?idInsumo='.$fila["idInsumo"].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a></div></td>';
                                        echo '<td>'.$fila['Nombre_insumo'].'</td>';	
										echo '<td>'.$fila['Cantidad'].'</td>';	
										echo '<td id="boton'.$fila['idInsumo'].'" >';
														$idInsumo=$fila["idInsumo"];																	
                                                                  //consulto en la bd si tal producto existe en la tabla det carrito donde el idPedido$idPedidoscompra es del usuario actual
                                                                  $sql="SELECT  Estado from det_ped_compra where idInsumo=? and idPedido_Compra=?" ;              
                                                                  $insumos=prepare_select($conexion,$sql,[$idInsumo,$idPedido_Compra]);  
                                                                  $fila=$insumos->fetch_assoc();
                                                                  $Estado=$fila['Estado'];
																	  if($Estado=="Pendiente")
																	  		{
																			echo  '<button  class="btn btn-danger btn-sm col-4" onclick="pedidook(this)" name="'.$idPedido_Compra.'" id="'.$idInsumo.'" ><strong>Pendiente</strong></button>';
																			  }
																	else{
																			echo ' <button class="btn btn-success btn-sm  " onclick="Pendiente(this)" name="'.$idPedido_Compra.'"  id="'.$idInsumo.'"  ><strong>✓</strong></button>';
																	}
										echo '</div> </td> </tr>';
								}
							?>	
						</tbody>
						
								
						
                    </table>
              </div>
				</div>
		</div> 
		
		<script>		
				function pedidook(str){
												idInsumo=str.id;
												idPedido_Compra=str.name;
												Recibido=1;
										var xmlhttp = new XMLHttpRequest();
										xmlhttp.onreadystatechange = function() {
											if (this.readyState == 4 && this.status == 200) {
															document.getElementById("boton"+idInsumo).innerHTML = this.responseText;
														}
													};
															fd= new FormData();
															fd.append('Recibido1',Recibido);
															fd.append('idInsumo',idInsumo);
															fd.append('idPedido_Compra',idPedido_Compra);
															xmlhttp.open("POST", "ajaxdetalle.php", true);
															xmlhttp.send(fd);
									}
				function Pendiente(str1){
										idInsumo=str1.id;
										idPedido_Compra=str1.name;
										
								var xmlhttp = new XMLHttpRequest();
								xmlhttp.onreadystatechange = function() {
									if (this.readyState == 4 && this.status == 200) {
													document.getElementById("boton"+idInsumo).innerHTML = this.responseText;
												}
											};
													fd= new FormData();
													fd.append('Pendiente1',Pendiente);
													fd.append('idInsumo',idInsumo);
													fd.append('idPedido_Compra',idPedido_Compra);
													xmlhttp.open("POST", "ajaxdetalle.php", true);
													xmlhttp.send(fd);
									}
						
		</script>
		
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>                   
    
                   
			
									
	<!--Pie de Pagina-->
	<?php require_once ('../Libs/Footer.php'); ?>