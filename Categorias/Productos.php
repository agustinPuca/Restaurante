<?php
session_start();
require_once ('../Libs/Header.php');
require_once('../Libs/MenuAdministrador.php');
?>
<?php
	if(!empty($_GET))
    {
        $idCategoria=$_GET['idCategoria_menu'];
        $sql="select m.idMenu,m.codigo_Menu,m.Nombre_Menu,m.Descripcion_Menu,m.Precio_menu,i.NombreArchivo from menu m inner join Imagenes i on m.idImagen=i.idImagen inner join producto_categoria pc on m.idMenu=pc.idMenu  where pc.idCategoria_menu=".$idCategoria;
        $menus= prepare_select($conexion,$sql);
    }
    //Recupero nombre de la categoria seleccionada
    $sql="SELECT Nombre_cat_menu FROM categoria_menu WHERE idCategoria_menu=?";
    $cmd=prepare_select($conexion,$sql,[$idCategoria]);
    $fila=$cmd->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
    $Nombre_Cat=$fila['Nombre_cat_menu'];

//var_dump($menus);
?>	
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloProducto.css">
	</head>
	<!--Tabla de menus-->
		<div class="todo col-11 mx-auto ">
				<div class="row text-center">
				<div class="table-responsive">	
				<table class="table table-striped bg-light "  >
                    <!--TIULO--->
                        <thead style="background-color:rgb(108,059,042)"> 
                                <th colspan="1"><h4><a href="index.php" ><i class="fas fa-list text-white "></i></a></h4></th>
                                <th colspan="4"> <h4 class="titulo2  text-white"><?php echo $Nombre_Cat;?></h4></th>
                        </thead >
                    <thead >
                            <?php 
                            echo '<th>Imagen</th>';
                            echo '<th>Nombre</th>';
                            echo '<th>Descripcion</th>';
                            echo '<th>Precio</th>';
                            echo '<th>Acciones</th>';
                            ?>
                    </thead>
						<tbody class="table-sm">
							<?php 
									foreach($menus as $fila)
								{
										echo '<tr>';
										echo '<td> <img src="/RESTAURANTE/Imagenes/'. $fila['NombreArchivo'].'" class="img  mx-auto"   alt="Card image cap" ></td>';		
                                        echo '<td>'.$fila['Nombre_Menu'].'</td>';	
                                        echo '<td>'.$fila['Descripcion_Menu'].'</td>';
                                        echo '<td>$ '.$fila['Precio_menu'].'</td>';						
									echo '<td><div class="botones d-flex   ">
											<div class="p-1  "><a href="delete_producto.php?idMenu='.$fila["idMenu"].'&idCategoria_menu='.$idCategoria.'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a></div> 
									 </div> </td> </tr>';
								}
							?>	
						</tbody>
						
								
						
                    </table>
                            </div>
				</div>
		</div>           
                    
<br>
<br>
<br>
<br>
<br>               
			
									
	<!--Pie de Pagina-->
	<?php require_once ('../Libs/Footer.php'); ?>