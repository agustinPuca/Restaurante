<?php
session_start();
require_once ('../Libs/Funciones.php');
require_once ('../Libs/Conexion.php');
date_default_timezone_set("America/Buenos_Aires");
?>
<?php
    
if(isset($_POST['accion']))
        {
                $idDetalle_Venta=$_POST['idDetalle_Venta'];
                $Estado1=$_POST['accion'];
                $idPedido1=$_POST['idPedido1'];
                switch ($Estado1) {
                case   'Pedido Completo':
                        $sql2="update detalle_pedido set Estado=? where  idPedidos_Venta=".$idPedido1;
                        $cmd3=prepare_query($conexion,$sql2,['Entregado']);
                        echo '<input type="submit" id="entregado" name="'.$fila['idDetella_Venta'].'" class = "btn btn-success btn-sm mx-auto " onclick="accion(this)" value="Entregado" />';
                        break;
                
                case 'Pendiente':
                        $sql2="update detalle_pedido set Estado=? where  idDetella_Venta=". $idDetalle_Venta;
                        $cmd3=prepare_query($conexion,$sql2,['Entregado']); 
                        echo '<input type="submit" id="entregado" name="'.$fila['idDetella_Venta'].'" class = "btn btn-success btn-sm mx-auto " onclick="accion(this)" value="'. $Estado1.'" />';
                break;
            }
        }
?>	
<?php 
 if(isset($_POST['idPedido']))
 {
    $idPedido=$_POST['idPedido'];
    $idMesa=$_POST['idMesa'];
        $sql="SELECT dp.*,m.Nombre_Menu,pv.Total from detalle_pedido dp INNER JOIN menu m on m.idMenu=dp.idMenu INNER JOIN pedidos_ventas pv on dp.idPedidos_Venta=pv.idPedido_Venta  where idPedidos_Venta=? ORDER BY m.Nombre_Menu ASC" ;
        $datos=prepare_select($conexion,$sql,[$idPedido]); 
        
?>
    <!--Tabla de menus-->
				    
                    <!--boton para ir a categorias-->
                    
                            <table class="table table-hover bg-light " id="table" style="margin:0">
                                    <!--TIULO--->
                                        
                                   <thead  class="text-center text-white bg-warning"  >
                                                <th>Menú</th>
                                                <th>Cantidad</th>
                                                <th>Guarnición</th>
                                                <th>Precio</th>
                                                <th>Pedido</th>
                                                <th>Subtotal</th>
                                                <th>Acción</th>
                                        </thead >
                                        <tbody>
                                            <?php  foreach($datos as $fila){ ?>
                                                       <tr >
                                                                <td class="" style="white-space: nowrap;width: 3%; text-transform: uppercase;"><strong><?php echo $fila['Nombre_Menu']; ?></strong></td>	
                                                                <td class="text-center " style="white-space: nowrap;width: 1%;" id="Cantidad" ><?php echo $fila['Cantidad']; ?></td>
                                                                <td class="text-center " style="white-space: nowrap;width: 1%;" id="Cantidad" ><?php echo $fila['Guarnicion']; ?></td>
                                                                <td class="text-center " style="white-space: nowrap;width: 2%;" id="Precio" >$<?php echo $fila['Precio']; ?></td>
                                                               <!-- <td class=" text-danger" style="white-space: nowrap;width: 2%;text-transform: uppercase;" id="Cantidad" ><strong><?php echo $fila['Estado']; ?></strong></td>-->
                                                                <!--<td  style="white-space: nowrap;width: 1%;"><input type="checkbox"  name="imgp" id="myCheck" onclick="uncheckOthers(this.id)" value="'. $imagen['iIdImagen'].'"   style="transform: scale(2);"></td>-->
                                                                        <td class=" text-center" id="boton<?php echo $fila["idDetella_Venta"] ?>" style="white-space: nowrap;width: 4%;">
                                                                                <? if($fila['Estado']=="Entregado"):?>
                                                                                        <input type="submit" id="<? echo $idPedido;?>" name="<? echo $fila['idDetella_Venta']?>" class = "btn btn-success btn-sm mx-auto "  value="<?php echo $fila['Estado']; ?>" />
                                                                                <? else:?>
                                                                                        <input type="submit" id="<? echo $idPedido;?>" name="<? echo $fila['idDetella_Venta']?>" class = "btn btn-danger btn-sm mx-auto " onclick="accion(this)" value="<?php echo $fila['Estado']; ?>" />
                                                                                <? endif ?>
                                                                        </td>
                                                                <td class="text-center" style="white-space: nowrap;width: 2%;" id="Subtotal" >$ <?php echo $fila['Subtotal']; ?></td>
                                                                 <td class=" text-center"  style="white-space: nowrap;width: 4%;">
                                                                    <?php  switch ($fila['Estado']) {
                                                                        case   'Entregado'||'Pendiente':
                                                                                echo '<input type="submit" id="Pagar" name="Pagar" class = "btn btn-warning btn-sm mx-auto "  value="Pagar" />';
                                                                                break;
                                                                        case   'Pagado':
                                                                                echo '<input type="submit" id="Pagado" name="Pagado" class = "btn btn-success btn-sm mx-auto " value="Pagado" />';
                                                                                break;
                                                                    }?>	
                                                                    </td>
                                                                    

                                                        </tr>
                                                    <? }?>  
                                                       <tr >
                                                                <td class="text-center text-white bg-warning" colspan="5" style="font: bold 2em/1 'trebuchet MS', Arial, Helvetica;">Total</td>
                                                                <td class="text-center text-white bg-warning" colspan="2"style="font: bold 2em/1 'trebuchet MS', Arial, Helvetica;" >$ <? echo $fila['Total']; ?></td>
                                                        </tr>                  
                                        </tbody>
                                            
                                         
                                    </table>

                                                <div  class="p-3"style="background-color:rgb(108,059,042);">
                                                        <div class="d-inline">
                                                        <input type="submit" id="<? echo $idPedido;?>" name="<? echo $fila['idDetella_Venta']?>" class = "btn btn-info btn-sm mx-auto " onclick="accion(this)" value="Pedido Completo" />
                                                        </div>
                                                        <div class=" d-inline float-right">
                                                                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><strong>Cerrar</strong></button>
                                                                        <button type="button" class="btn btn-warning "><strong>Pagar Todo</strong></button>
                                                        </div>
                                                </div>
                                                              
                                                                <? }?>   

                             
                                 
                                                
       