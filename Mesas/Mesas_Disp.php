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
<?php
                $sql="select * from mesas ";
                $mesas=prepare_select($conexion,$sql);
                
            ?>
                    <h3 class="ml-5 text-white" style="position: absolute; top: 11px; right:30px;">Mesas</h3></th>

<div class="todo col-11 mx-auto ">
                    

				    <div class="table-responsive">  
                    <!--boton para ir a categorias-->
                    <? if($_SESSION['Nombre_Categoria']=='Mozo'):?>
                        <a href="../Style/IndexMozo.php" class="btn btn-success   "><i class="fas fa-arrow-left mr-2"></i> Menu</a>
                    <? else:?>
                        <a href="../Style/IndexCajero.php" class="btn btn-success   "><i class="fas fa-arrow-left mr-2"></i> Inicio</a>
                    <? endif ?>
                                <table class="table table-striped bg-light " id="table" >
                                    <!--TIULO--->
                                        
                                        <thead  class="text-center text-white" style="background-color:rgb(108,059,042)" >
                                                <th>N° Mesa</th>
                                                <th>Capacidad</th>
                                                <th>Estado</th>
                                                <th>Total</th>
                                                <th>Accion</th>
                                        </thead >
                                        <tbody class="table-sm">
                                            <?php  foreach($mesas as $mesa):?> 
                                                <?php 
                                                        $idMesa=$mesa['idMesa'];
                                                            $sql1="SELECT * FROM pedidos_ventas where idMesa=?";
                                                            $cmd=prepare_select($conexion,$sql1,[$idMesa]);
                                                            if($cmd){
                                                                $fila=$cmd->fetch_assoc();
                                                            }
                                                        switch ($mesa['Estado']){
                                                            case 'Abierta':
                                                                    echo '<tr class="bg-success text-white">';
                                                                break;
                                                            case 'Facturar': //Cuando se emite el tiket elestado de la mesa es amarrillo
                                                                    echo  '<tr class="bg-warning  text-white">';
                                                                break;
                                                            case 'Facturada': 
                                                                    echo '<tr class="bg-danger text-white">';
                                                                break;
                                                            case 'Libre':         
                                                                echo '<tr>';
                                                                break;
                                                        }
                                                ?>
                                                                <td class="text-center" style="white-space: nowrap;width: 2%; text-transform: uppercase;"><strong><?php echo $idMesa; ?></strong></td>	
                                                                <td class="text-center " style="white-space: nowrap;width: 2%; text-transform: uppercase;"> <? echo $mesa['Capacidad'];?></td>
                                                                <td  class="text-center " style="white-space: nowrap;width: 2%;" id="Estado" name="Estado"><strong><?php echo $mesa['Estado']; ?></strong></td>  
                                                                <td  class="text-center " style="white-space: nowrap;width: 2%;" id="Total" name="Total"><strong><?php echo $fila['Total']; ?></strong></td>                       
                     
                                                                <td class=" text-center" id="boton" style="white-space: nowrap;width: 4%;">
                                                                <a  href="../Pedido_Venta/detalle_pedido.php?idPedido=<?php echo $fila['idPedido_Venta'];?>&idMesa=<?php echo $idMesa; ?>&Mozo=1" class = "btn btn-info  mx-auto col-5">Detalle</a> 
                                                                </td>
                                                        </tr>
                                            
                                            <?php endforeach; ?>	
                                                
                                        </tbody>
                                                 
                                        
                                    </table>
                        
                    
			    </div>
                	
         </div> 