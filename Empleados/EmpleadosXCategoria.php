<?php
session_start();
require_once ('../Libs/Header.php');
require_once('../Libs/MenuAdministrador.php');
?>
<?php
    if(isset($_GET['idCategoria'])){
        $idCategoria=$_GET['idCategoria'];
            $sql="SELECT e.*, ce.Nombre_Categoria from empleados e inner join Categoria_Empleado ce on e.idCategoria=ce.idCategoria WHERE ce.idCategoria=? ORDER BY Nombre ASC";
            $datos= prepare_select($conexion,$sql,[$idCategoria]);
            if($datos->num_rows>0)
           {
               $categoria=$datos->fetch_assoc();
           }
    }
//var_dump($datos);
?>	
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloIndex.css">
</head>
	<!--Tabla de datos-->
<div class="todo col-11 mx-auto ">
		<div class="row text-center">	
				<div class="table-responsive">	
				    <table class="table  bg-light table-sm">
							<thead style="background-color:rgb(108,059,042)">
										<th colspan="2"><a href="indexCategoria.php" class="lista" ><h2><i class="lista fas fa-list text-white"></i></h2></a></th>
										<th colspan="5" ><h4 class="titulo text-white "><? echo $categoria['Nombre_Categoria'];?></h4></th>
								</thead >
                                <thead >
                            <?php 
                            echo '<th>Nombre</th>';
                            echo '<th>Apellido</th>';
							//echo '<th>Usuario</th>';
							//echo '<th>Clave</th>';
							echo '<th>Edad</th>';
							echo '<th>Categoria</th>';
                            echo '<th>Acciones</th>';
                            ?>
                    </thead>
						<tbody>
							<?php 
									foreach($datos as $fila)
								{
									echo '<tr>';
                                        echo '<td>'.$fila['Nombre'].'</td>';	
                                        echo '<td>'.$fila['Apellido'].'</td>';
										//echo '<td>'.$fila['Login'].'</td>';
										//echo '<td>'.$fila['Clave'].'</td>';
										echo '<td>'.$fila['Edad'].' Años</td>';
										echo '<td>'.$fila['Nombre_Categoria'].'</td>';
									echo '<td><div class="botones d-flex   ">
									<div class=" p-1"><a href="datos_empleado.php?idEmpleado='.$fila["idEmpleado"].'"class="btn btn-success btn-sm">Informacion</a></div> 
											<div class="p-1"><a href="Update_Empleado.php?idEmpleado='.$fila["idEmpleado"].'"class="btn btn-primary btn-sm"><i class="far fa-edit mr-1"></i>Modificar</a></div> 
											<div class=" p-1"><a href="delete.php?idEmpleado='.$fila["idEmpleado"].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt mr-1"></i>Eliminar</a></div> 
                                            </div> </td> </tr>';
								}
							?>	
						</tbody>
						
								
						
					</table>
                </div>
		</div>
</div>
<?php require_once('../Libs/Footer.php'); ?>
   
           
                    
    
                   
	