<?php
session_start();
require_once ('../Libs/Header.php');
?>
<?php
    $busqueda = $_REQUEST["q"];//dato a buscar letra o palabra
        if(isset($busqueda))
        {
            $sql="SELECT * from mesas where idMesa like '%".$busqueda."%'";
        }
        else{
            $sql="SELECT m.idMenu, m.Codigo_Menu, m.Nombre_Menu, m.Descripcion_Menu, m.Precio_Menu, i.NombreArchivo,cm.Nombre_Cat_menu from menu m inner join Imagenes i on m.idImagen=i.idImagen inner join Mesa_categoria pc on m.idMenu=pc.idMenu inner join categoria_menu cm on pc.idCategoria_Menu=cm.idCategoria_Menu ";
        }
        $Mesas= prepare_select($conexion,$sql);
?>
        
           <?php if ($Mesas->num_rows >0) : ?>
            <?php  while($Mesa=$Mesas->fetch_assoc()):?> 
       
                <table class="table bg-light text-center"  >
					
						<tbody>
							<?php 
									echo '<tr >';

                                    echo '<td height="10">'.$Mesa['idMesa'].'</td>';							
                                    echo '<td height="10">'.$Mesa['Capacidad'].'</td>';
                                    echo '<td height="10"><div class="botones d-flex   ">
                                                <div class="p-1"><a href="update.php?idProveedor='.$Mesa["idProveedor"].'"class=" btn-primary btn-sm"><i class="far fa-edit mr-1"></i></a></div> 
                                                <div class=" p-1"><a href="Detalle.php?idPedido_Compra='.$Mesa["idPedido_Compra"].'"class="btn-info btn-sm"><i class="fas fa-list text-white mr-1 "></i></a></div> 
                                                </div> 
                                          </td> 
                                </tr>';
							?>	
						</tbody>
                    </table>
             <?php endwhile;?>
             <?php else:?>
                  <div class="alert alert_danger" style="grid-column:1/5">Mesa no Existe</div>          
             <?php endif;?>
    
