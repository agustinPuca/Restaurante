
<?php
require_once ('barralogo.php');
?>

<head>
			<style>
                    .men{
                            background:linear-gradient(#fac754, #f8ac00); 
                            height:35px;
                        }
 
                        * {
				margin:0px;
				padding:0px;
			}
			
			#header {
				margin:auto;
				width:500px;
				font-family:Arial, Helvetica, sans-serif;
			}
			
			ul, ol {
				list-style:none;
			}
			
			.nav > li {
				float:left;
			}
			
			.nav li a {
             
				color:#808080;
				text-decoration:none;
				padding:6px 12px;
                display:block;
                
			}
			
			.nav li a:hover {
                background:rgb(108,059,042);
                color:white; 
			}
			
			.nav li ul {
				display:none;
				position:absolute;
                min-width:140px;
                z-index: 2;
			}
			
			.nav li:hover > ul {
				display:block;
			}
			
			.nav li ul li {
				position:relative;
			}
			
			.nav li ul li ul {
				right:-140px;
				top:0px;
			}
			
			
			
			
			
			
		</style>
            </style>
	</head>
    <?php
            $idCategoria_Empleado=$_SESSION["idCategoria"];
		 		//Recupero nombre de la categoria seleccionada
				$sql="SELECT Nombre_Categoria FROM categoria_empleado WHERE idCategoria=?";
				$cmd=prepare_select($conexion,$sql,[$idCategoria_Empleado]);
				$fila=$cmd->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
				$Nombre_Cat=$fila['Nombre_Categoria'];
	?>


<nav class="men navbar navbar-expand-lg navbar-light  ">
<div class="container col-12 ">
<?php if($Nombre_Cat=='Administrador') {?>
  <div id="header">
			<nav> <strong>
    <ul class="nav">
                             <li > <a  class="nav-link text-white"><strong>Menu</strong></a>
                                    <ul class="bg-light">
                                        <li class="border-bottom border-warning"><a href="../Categorias/Create.php">Agregar Categoria de Menu</a></li>
                                         <li class="border-bottom border-warning"><a href="../Productos/Create.php">Agregar Menu</a></li>
                                         <li class="border-bottom border-warning"><a href="../Productos/index.php">Menus: Modificar - Eliminar</a></li>
                                        <li class="border-bottom border-warning"><a href="../Categorias/index.php">Categorias: Modificar - Eliminar- Menu por Cat</a></li>
                                
                                    </ul>
                                </li>
                                <li><a class="nav-link text-white"><strong>Insumos</strong></a>
                                    <ul class="bg-light">
                                        <li class="border-bottom border-warning"><a href="../Insumos/1CreateCat.php">Agregar Categoria de Inusmo</a></li>
                                        <li class="border-bottom border-warning"><a href="../Insumos/CreateInsumo.php">Agregar Insumo</a></li>
                                        <li class="border-bottom border-warning"><a href="../Insumos/IndexInsumo.php">Lista Insumo Modificar - Eliminar</a></li>
                                        <li class="border-bottom border-warning"><a href="../Insumos/1IndexCat.php">Lista Categoria Modificar - Eliminar</a></li>
                                    </ul>
                                </li>
                                <li><a class="nav-link text-white"><strong>Compras</strong></a>
                                    <ul class="bg-light">
                                        <li class="border-bottom border-warning"><a href="../Pedido_Compra/Create.php">Agregar Pedido</a></li>
                                        <li class="border-bottom border-warning"><a href="../Proveedores/Create.php">Agregar Proveedor</a></li>
                                        <li class="border-bottom border-warning"><a href="../Proveedores/Index.php">Proveedores Modificar - Eliminar</a></li>
                                        <li class="border-bottom border-warning"><a href="../Pedido_Compra/Index.php">Pedidos Modificar-Eliminar</a></li>
                                    </ul>
                                </li>
                                <li><a  class="nav-link text-white"><strong>Empleados</strong></a>
                                    <ul class="bg-light">
                                        <li class="border-bottom border-warning"><a href="../Empleados/CategoriaEmpleado.php">Agregar Rol</a></li>
                                        <li class="border-bottom border-warning"><a href="../Empleados/CreateEmpleado.php">Alta de Empleado </a></li>
                                        <li class="border-bottom border-warning"><a href="../Empleados/Index.php">Empleados: Modificar-Eliminar</a></li>
                                        <li class="border-bottom border-warning"><a  href="../Empleados/indexCategoria.php">Roles: Eliminar - Empleado por Rol</a></li>
                                    </ul>
                                </li>
                                
    </ul></strong>
    </nav><!-- Aqui estamos cerrando la nueva etiqueta nav -->
</div>
  
<?php } ?> 
  
                            <div class="collapse navbar-collapse justify-content-between " id="navbarNav">
                                              
                                        <ul class="navbar-nav ml-auto ">
                                                <?php if(!isset($_SESSION["idEmpleado"])){?>
                                                <?php } else { ?>        
                                                        <h5><li class="nav-item dropdown mr-auto   ">
                                                             <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" >
                                                                    <i class="fas fa-user-circle mr-1 "></i><?php echo  $_SESSION["Login"];?>
                                                                </a>
                                                            
                                                                
                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">                            
                                                                <a class="dropdown-item" href="#">Mis Datos</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="../Acceso/loginout.php"><i class="fas fa-sign-out-alt"></i>Cerrar Sesion  </a>
                                                            </div>
                                                        </li></h5>
                                                      
                                                        
                                                 <?php } ?>
                                        </ul>
                                    </div>
    </div>
</nav>
      

			