<?php
session_start();
require_once ('../Libs/header.php');
require_once('../Libs/barramozo.php');
date_default_timezone_set("America/Buenos_Aires");
?>
<?php
    if(isset($_GET))
        {
            $idPedido=$_GET['idPedido'];
            $idMesa=$_GET['idMesa'];
                $sql="SELECT dp.*,m.Nombre_Menu,pv.Total from detalle_pedido dp INNER JOIN menu m on m.idMenu=dp.idMenu INNER JOIN pedidos_ventas pv on dp.idPedidos_Venta=pv.idPedido_Venta  where idPedidos_Venta=? ORDER BY m.Nombre_Menu ASC" ;
                $datos=prepare_select($conexion,$sql,[$idPedido]); 
        }
    
?>	
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/menu.css">
	</head>
    <!--Tabla de menus-->
    <h4 class="ml-5 text-white" style="position: absolute; top: 11px; right:30px;">Mesa N° <?php echo $idMesa;?></h4></th>
<div class="todo col-11 mx-auto ">
				    <div class="table-responsive">  
                    <!--boton para ir a categorias-->
                    <? if(isset($_GET['Mozo'])):?>
                        <a href="../Mesas/Mesas_Disp.php" class="btn btn-success   "><i class="fas fa-arrow-left mr-2"></i>Mesas</a>
                    <? else :?>  
                        <a href="indexPedidos.php" class="btn btn-success   "><i class="fas fa-arrow-left mr-2"></i>Pedidos</a>
                    <? endif ?>
                        <a href="index.php?idMesa=<?php echo $idMesa; ?>&idPedido=<?php echo $idPedido; ?> " class="btn btn-info float-right " style=""><strong>+ </strong> Agregar Menu</a>
                                <table class="table table-striped bg-light table-sm " id="table" >
                                    <!--TIULO--->
                                        
                                        <thead  class="text-center text-white" style="background-color:rgb(108,059,042)" >
                                                <th>Menú</th>
                                                <th>Cantidad</th>
                                                <th>Guarnición</th>
                                                <th>Precio</th>
                                                <th>Estado</th>
                                                <th>Subtotal</th>
                                        </thead >
                                        <tbody>
                                            <?php  foreach($datos as $fila){ ?>
                                                       <tr >
                                                                <td class="" style="white-space: nowrap;width: 3%; text-transform: uppercase;"><strong><?php echo $fila['Nombre_Menu']; ?></strong></td>	
                                                                <td class="text-center" style="white-space: nowrap;width: 2%;" id="Cantidad" ><?php echo $fila['Cantidad']; ?></td>
                                                                <td class="text-center" style="white-space: nowrap;width: 2%;" id="Cantidad" ><?php echo $fila['Guarnicion']; ?></td>
                                                                <td class="text-center" style="white-space: nowrap;width: 2%;" id="Precio" ><?php echo $fila['Precio']; ?></td>
                                                                <td class="text-center text-danger" style="white-space: nowrap;width: 2%;text-transform: uppercase;" id="Cantidad" ><strong><?php echo $fila['Estado']; ?></strong></td>
                                                                <td class="text-center" style="white-space: nowrap;width: 2%;" id="Subtotal" ><?php echo $fila['Subtotal']; ?></td>
                                                    </tr>
                                              <?php } ?>	
                                        </tbody>
                                            
                                        <tr  class="text-center text-white" style="background-color:rgb(108,059,042)" >
                                                <td colspan="4" style="font: bold 1.8em/1 'trebuchet MS', Arial, Helvetica;">Total</td>
                                                <td colspan="2"style="font: bold 1.5em/1 'trebuchet MS', Arial, Helvetica;" >$ <? echo $fila['Total']; ?></td>
                                        </tr >
                                    </table>
                                    
                   </div>
                	
         </div> 