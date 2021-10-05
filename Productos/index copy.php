<?php
session_start();
require_once ('../Libs/Header.php');
require_once('../Libs/MenuAdministrador.php');
?>
<?php
	
	$sql="select m.idMenu, m.Codigo_Menu, m.Nombre_Menu, m.Descripcion_Menu, m.Precio_Menu, i.NombreArchivo,cm.Nombre_Cat_menu from menu m inner join Imagenes i on m.idImagen=i.idImagen inner join producto_categoria pc on m.idMenu=pc.idMenu inner join categoria_menu cm on pc.idCategoria_Menu=cm.idCategoria_Menu ORDER BY Nombre_menu ASC";
$productos= prepare_select($conexion,$sql);
$campos=$productos->fetch_fields(); //Devuelve un array de objetos que representan los campos de un conjunto de resultado
//var_dump($productos);
?>	

<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloProducto.css">
</head>
	<!--Tabla de Productos-->
<div class="todo container ">
<nav class="navbar navbar-light justify-content-between navbar-sm" style="background-color:rgb(108,059,042)">
											<h4><a href="Create.php"><h3><i class="fas fa-plus-circle text-white "></i></h3></a></h4>
											<h4 class="text-center text-white ml-5">Menu</h4>
											<form>
													 <input type="text" name="buscador" onkeyup="showHint(this.value)">
											</form>
									</nav>
		
		<div class="table-responsive" >	
				<table class="table bg-light text-center table-sm"  >
								
					<thead >
                            <?php 
                            echo '<th>Imagen</th>';
                            echo '<th>Nombre</th>';
                            echo '<th>Descripcion</th>';
							echo '<th>Precio</th>';
							echo '<th>Categoria</th>';
                            echo '<th>Acciones</th>';
                            ?>
                    </thead>
						<tbody id="table">
							<?php 
									foreach($productos as $fila)
								{
										echo '<tr>';
										echo '<td> <img src="/RESTAURANTE/Imagenes/'. $fila['NombreArchivo'].'" class="img  mx-auto"   alt="Card image cap" ></td>';		
                                        echo '<td>'.$fila['Nombre_Menu'].'</td>';	
                                        echo '<td>'.$fila['Descripcion_Menu'].'</td>';
										echo '<td> $ '.$fila['Precio_Menu'].'</td>';
										echo '<td>'.$fila['Nombre_Cat_menu'].'</td>';
									echo '<td><div class="botones d-flex   ">
											<div class="p-1 "><a href="update.php?idMenu='.$fila["idMenu"].'"class="btn btn-primary btn-sm"><i class="far fa-edit mr-1"></i>Modificar</a></div> 
											<div class="p-1  "><a href="delete.php?idMenu='.$fila["idMenu"].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt mr-1"></i>Eliminar</a></div> 
									 </div> </td> </tr>';
								}
							?>	
						</tbody>
					</table>
		
	</div>
</div>



<script>
function showHint(str) {
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				document.getElementById("table").innerHTML = this.responseText;
            }
		};
			if (str.length == 0) {
					xmlhttp.open("GET", "menu.php?q=" + "");
					xmlhttp.send();
			}else{
					xmlhttp.open("GET", "menu.php?q=" + str, true);
					xmlhttp.send();
				} 
	
}
</script>						
	<!--Pie de Pagina-->
	<?php require_once ('../Libs/Footer.php'); ?>