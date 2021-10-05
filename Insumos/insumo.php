<?php
session_start();
require_once ('../Libs/Header.php');
?>
<?php 
    $busqueda = $_REQUEST["q"];//dato a buscar letra o palabra
        if(isset($busqueda))
        {
            $sql="SELECT i.*,Nombre_cat_insumo  from Insumos i inner join categoria_insumo ci on i.idCategoria_Insumo=ci.idCategoria_Insumo where i.Nombre_Insumo like '%".$busqueda."%'";
        }
        else{
            $sql="SELECT i.*,Nombre_cat_insumo  from Insumos i inner join categoria_insumo ci on i.idCategoria_Insumo=ci.idCategoria_Insumo ";
        }
        $Insumos= prepare_select($conexion,$sql);
?>
  <?php if ($Insumos->num_rows >0) : ?>
            <?php  while($insumo=$Insumos->fetch_assoc()):?> 
       
                <table class="table bg-light text-center"  >
					
						<tbody>
							<?php 
									echo '<tr>';

                                    echo '<td>'.$insumo['Nombre_Insumo'].'</td>';							
                                    echo '<td>'.$insumo['Descripcion_Insumo'].'</td>';
                                    echo '<td>'.$insumo['Nombre_cat_insumo'].'</td>';
                                    echo '<td><div class="botones d-flex   ">
                                                <div class="p-1"><a href="updateInsumo.php?idInsumo='.$insumo["idInsumo"].'"class="btn btn-primary btn-sm"><i class="far fa-edit mr-1"></i>Modificar</a></div> 
                                                <div class=" p-1"><a href="DeleteInsumo.php?idInsumo='.$insumo["idInsumo"].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt mr-1"></i>Eliminar</a></div> 
                                                </div> 
                                          </td> 
                                </tr>';
								
							?>	
						</tbody>
                    </table>
             <?php endwhile;?>
             <?php else:?>
                  <div class="alert alert_danger" style="grid-column:1/5">Insumo no Existe</div>          
             <?php endif;?>
