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
<head>
			<!-- css-->
            <link rel="stylesheet" type="text/css" href="Css/Create.css">
            <script type="text/javascript" src="Js/Create.js"></script>
</head>
<?php

				if(!empty($_POST['agregar_mesa'])) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                {
                    $Capacidad	 =$_POST["Capacidad"];
					//insertar en la base
					$sql="insert into Mesas (Capacidad,Estado) value(?,?)";
					$cmd= prepare_query($conexion,$sql,[$Capacidad,'Libre']);
					
                }
                if(isset($_POST['n_mesa'])){
                    $n_mesa=$_POST['n_mesa'];
                    $capacidad=$_POST['Capacidad'];
                    $sql="update mesas SET Capacidad=? where idMesa=?";
                        $datos1=prepare_query($conexion,$sql,[$capacidad,$n_mesa]);
            }
	
?>
<?php
$sql="select * from mesas";
$mesas=prepare_select($conexion,$sql);?>
<div class="todo container col-11">
									<nav class="navbar navbar-light justify-content-between" style="background-color:rgb(108,059,042)">
                                    <form><input class="btn bg-white btn-sm ml-4" type="text" placeholder = "Buscar Mesa" name="buscador" onkeyup="showHint(this.value)"></form>
                                     <h3 class="text-center text-white ">Mesas</h3>
                                            <form class="form-inline float-right" action="create.php" method="POST" enctype="multipart/form-data">
                                            <input type="number" min="1" name="Capacidad" id="Capacidad1" placeholder = "Capacidad" class="btn bg-white btn-sm mr-1 col-5">
														<input type="submit" id="boton" name="agregar_mesa" value="Agregar Mesa" class="btn btn-success btn-sm text-white " onclick="borrar()">
											</form>
									</nav>
				<div class="table-responsive">
                <form class="form-inline " action="create.php" method="POST" enctype="multipart/form-data"> 
	
				<table class="table  bg-light"   style="border-collapse: collapse;" >
							
                            <thead  class="text-center" >
                                    <th>N° Mesa</th>
                                    <th>Capacidad</th>
									<th>Acciones</th>
							</thead >
						<tbody  class="text-center" id="table">
							<?php 
									foreach($mesas as $fila)
								{
									echo '<tr >';

											echo '<td>'.$fila['idMesa'].'</td>';							
                                            echo '<td>'.$fila['Capacidad'].'</td>';
                                            echo ' 

                                            <td >
                                            <span type="submit" class="btn btn-primary btn-sm"  onclick="transformarEnEditable(this)"><i class="far fa-edit mr-1"></i>Modificar</span>
                                                        
                                                  </td> 
                                        </tr>';
								}
							?>	
						</tbody>
						
								
						
                    </table>
                    </form>
							</div>
				
</div>

	
