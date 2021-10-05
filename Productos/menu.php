<?php
session_start();
require_once ('../Libs/Header.php');
?>
<?php
    $busqueda = $_REQUEST["q"];//dato a buscar letra o palabra
        if(isset($busqueda))
        {
            $sql="SELECT m.idMenu, m.Codigo_Menu, m.Nombre_Menu, m.Descripcion_Menu, m.Precio_Menu, i.NombreArchivo,cm.Nombre_Cat_menu from menu m inner join Imagenes i on m.idImagen=i.idImagen inner join producto_categoria pc on m.idMenu=pc.idMenu inner join categoria_menu cm on pc.idCategoria_Menu=cm.idCategoria_Menu where m.Nombre_Menu like '%".$busqueda."%'";
        }
        else{
            $sql="SELECT m.idMenu, m.Codigo_Menu, m.Nombre_Menu, m.Descripcion_Menu, m.Precio_Menu, i.NombreArchivo,cm.Nombre_Cat_menu from menu m inner join Imagenes i on m.idImagen=i.idImagen inner join producto_categoria pc on m.idMenu=pc.idMenu inner join categoria_menu cm on pc.idCategoria_Menu=cm.idCategoria_Menu ";
        }
        $Productos= prepare_select($conexion,$sql);
?>
        
           <?php if ($Productos->num_rows >0) : ?>
            <?php  while($producto=$Productos->fetch_assoc()):?> 
       
                <table class="table bg-light text-center"  >
					
						<tbody>
							<?php 
										echo '<tr>';
										echo '<td> <img src="/RESTAURANTE/Imagenes/'. $producto['NombreArchivo'].'" class="img  mx-auto"   alt="Card image cap" ></td>';		
                                        echo '<td>'.$producto['Nombre_Menu'].'</td>';	
                                        echo '<td>'.$producto['Descripcion_Menu'].'</td>';
										echo '<td> $ '.$producto['Precio_Menu'].'</td>';
										echo '<td>'.$producto['Nombre_Cat_menu'].'</td>';
									echo '<td><div class="botones d-flex   ">
											<div class="p-1 "><a href="update.php?idMenu='.$producto["idMenu"].'"class="btn btn-primary btn-sm"><i class="far fa-edit mr-1"></i>Modificar</a></div> 
											<div class="p-1  "><a href="delete.php?idMenu='.$producto["idMenu"].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt mr-1"></i>Eliminar</a></div> 
									 </div> </td> </tr>';
								
							?>	
						</tbody>
                    </table>
             <?php endwhile;?>
             <?php else:?>
                  <div class="alert alert_danger" style="grid-column:1/5">Menu no Existe</div>          
             <?php endif;?>
    
