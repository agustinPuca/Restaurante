<?php
session_start();
require_once ('../Libs/Header.php');
require_once('../Libs/MenuAdministrador.php');
?>
<?php
	if(isset($_GET)){
        $idEmpleado=$_GET['idEmpleado'];
            $sql="SELECT e.*, ce.Nombre_Categoria from empleados e inner join Categoria_Empleado ce on e.idCategoria=ce.idCategoria where e.idEmpleado=? ";
            $Categorias= prepare_select($conexion,$sql,[$idEmpleado]);
            $campos=$Categorias->fetch_fields(); //Devuelve un array de objetos que representan los campos de un conjunto de resultados
    }
//var_dump($Categorias);
?>	
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/EstiloIndex.css">
</head>
	<!--Tabla de Categorias-->
<div class="todo col-6 mx-auto ">
		
				<div class="table-responsive">	
				    <table class="table  table-striped bg-light table-sm "  >
						
							<?php 
									foreach($Categorias as $fila)
								{
                                    echo '<thead style="background-color:rgb(108,059,042)">';
                                        echo '<th colspan="1"><a href="index.php"  ><h3> <i class=" fas fa-list text-white ml-3"></i></h3></a></th>';
                                        echo '<th colspan="2" ><h3 class=" text-white ml-5 ">'. $fila['Nombre_Categoria'].'</h3></th>';
                                    echo '</thead>'; 
                                   echo '<tbody class="table-bordered ">';
                                                echo '<tr>';
                                                     echo '<th colspan="3" class=" text-center">Empleado N° '.$fila['idEmpleado'].'</th>';
                                                echo '</tr>';

                                                echo '<tr>';
                                                        echo '<th>Nombre - Apellido</th>';
                                                        echo '<td class=" text-center">'.$fila['Nombre'].'</td>';
                                                        echo '<td class=" text-center">'.$fila['Apellido'].'</td>';
                                                echo '</tr>'; 

                                                echo '<tr>'; 
                                                        echo '<th>Login - Contraseña</th>';
                                                        echo '<td class=" text-center">'.$fila['Login'].'</td>';
                                                        echo '<td class=" text-center">'.$fila['Clave'].'</td>';
                                                echo '</tr>'; 
                        
                                                echo '<tr>'; 
                                                        echo '<th> Edad - Fecha Nac.</th>';
                                                        echo '<td class=" text-center">'.$fila['Edad'].' Años</td>';
                                                        echo '<td class=" text-center">'.$fila['Fecha_Nac'].'</td>';
                                                echo '</tr>'; 
                                                
                                                echo '<tr>';
                                                        echo '<td><strong> E-Mail</strong></td>';
                                                        echo '<td colspan="2"  class=" text-center">'.$fila['Email'].'</td>';
                                                echo '</tr>'; 
                                                echo '<tr>'; 
                                                        echo '<th >Domicilio - DNI </th>';
                                                        echo '<td class=" text-center">'.$fila['Domicilio'].'</td>';
                                                        echo '<td class=" text-center">'.$fila['DNI'].'</td>';
                                                echo '</tr>'; 
                                                echo '<tr>'; 
                                                        echo '<th> Fecha  de Alta</th>';
                                                        echo '<td colspan="2" class=" text-center">'.$fila['Fecha_Alta'].'</td>';
                                                echo '</tr>'; 
                                                

                                           echo '</tbody>';     
                                     
								}
							?>	
						
						
								
						
					</table>
                </div>
		</div>
</div>
<?php require_once('../Libs/Footer.php'); ?>