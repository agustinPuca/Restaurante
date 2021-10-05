<?php
session_start();
require_once ('../Libs/Header.php');
require_once('../Libs/MenuAdministrador.php');
?>
<head>
    <!-- css-->
            <link rel="stylesheet" type="text/css" href="Css/Gerente.css">
            <title>Inicio</title>
</head>

<?php

$Nombre_Cat=$_SESSION["Nombre_Categoria"];

        if($Nombre_Cat == 'Administrador'){?>
            <div class="todo container col-11">
                <div class="row row-cols-1 my-4 row-cols-md-3  ">              
            <!--Alta de Empleado -->
                        <div class="state">
                            <div class="col mb-4   ">
                                            <div class="card h-100 ">
                                                <div class="portada text-center bg-info" >
                                                            <a class="enlace" style="text-decoration: none;" href="../Empleados/index.php" type="button" > 
                                                                <h2 class="card-title  text-white my-5" >Empleados</h2>
                                                            </a>     
                                                </div>
                                                        <div class="card-footer  " Style="background:linear-gradient(#fac754, #f8ac00); opacity:.9; "> 
                                                                        <a href="../Empleados/CreateEmpleado.php" class="op nav-item nav-link"><li>Alta de Empleado</li></a>
                                                                        <a href="../Empleados/indexCategoria.php" class="op nav-item nav-link"><li>Roles</li></a> 
                                                                        <a href="../Empleados/CategoriaEmpleado.php" class="op nav-item nav-link"><li>Insertar Rol</li></a>              
                                                        </div>
                                            </div>
                                </div> 
                            </div>


        <!--Productos -->
                        <div class="state">
                        <div class="col mb-4   ">
                                        <div class="card h-100 ">
                                            <div class="portada text-center bg-danger" >
                                                        <a class="enlace" style="text-decoration: none;" href="../Productos/index.php" type="button" > 
                                                            <h2 class="card-title  text-white my-5" >Menu</h2>
                                                        </a>     
                                            </div>
                                                    <div class="card-footer  " Style="background:linear-gradient(#fac754, #f8ac00); opacity:.9; "> 
                                                                    <a href="../Categorias/Index.php" class="op nav-item nav-link"><li>Categorias</li></a>
                                                                <a href="../Productos/create.php" class="op nav-item nav-link"><li>Insertar Menu</li></a>  
                                                                <a href="../Categorias/create.php" class="op nav-item nav-link"><li>Insertar Categoria</li></a>            
                                                    </div>
                                        </div>
                            </div> 
                        </div>

        <!--Pedidos de Compra-->
                        <div class="state">
                        <div class="col mb-4   ">
                                        <div class="card h-100 ">
                                            <div class="portada text-center bg-success" >
                                                        <a class="enlace " style="text-decoration: none;" href="../Pedido_Compra/index.php" type="button" > 
                                                            <h2 class="card-title  text-white my-5" >Pedidos de Compra</h2>
                                                        </a>     
                                            </div>
                                                    <div class="card-footer  " Style="background:linear-gradient(#fac754, #f8ac00);  opacity:.9; ">
                                                                <a href="../Proveedores/Index.php" class="op nav-item nav-link"><li>Proveedores</li></a>  
                                                                <a href="../Pedido_Compra/Create.php" class="op nav-item nav-link"><li>Insertar Pedido</li></a> 
                                                                <a href="../Proveedores/Index.php" class="op nav-item nav-link"><li>Insertar Proveedor</li></a>   
                                                                        
                                                    </div>
                                        </div>
                            </div> 
                        </div>
        <!--Productos -->
        <div class="state">
                        <div class="col mb-4   ">
                                        <div class="card h-100 ">
                                            <div class="portada text-center bg-secondary" >
                                                        <a class="enlace" style="text-decoration: none;" href="../Insumos/indexInsumo.php" type="button" > 
                                                            <h2 class="card-title  text-white my-5" >Insumos</h2>
                                                        </a>     
                                            </div>
                                                    <div class="card-footer  " Style="background:linear-gradient(#fac754, #f8ac00); opacity:.9; "> 
                                                                    <a href="../Insumos/CreateInsumo.php" class="op nav-item nav-link"><li>Insertar Insumo</li></a>
                                                                    <a href="../Insumos/1IndexCat.php" class="op nav-item nav-link"><li>Categorias de Insumos</li></a>        
                                                                <a href="../Insumos/1CreateCat.php" class="op nav-item nav-link"><li>Insertar Categoria Insumo</li></a>            
                                                    </div>
                                        </div>
                            </div> 
            </div>
            <!--Mesas-->
            <div class="state">
                        <div class="col mb-4   ">
                                        <div class="card h-100 ">
                                            <div class="portada text-center bg-warning" >
                                                        <a class="enlace " style="text-decoration: none;" href="../Pedido_Compra/index.php" type="button" > 
                                                            <h2 class="card-title  text-white my-5" >Mesas</h2>
                                                        </a>     
                                            </div>
                                                    <div class="card-footer  " Style="background:linear-gradient(#fac754, #f8ac00);  opacity:.9; ">
                                                                <a href="../Mesas/Create.php" class="op nav-item nav-link"><li>Agregar y ver Mesas</li></a>  
                                                                <a href="../Pedido_Compra/Create.php" class="op nav-item nav-link"><li>Reservar </li></a> 
                                                                <a href="../Proveedores/Index.php" class="op nav-item nav-link"><li>Reservaciones</li></a>   
                                                                        
                                                    </div>
                                        </div>
                            </div> 
                        </div>
                    
            </div> 
        </div> 

        <?php require_once('../Libs/footer.php');?>
        <?php }else {?>
        <img src="../Imagenes/restringido.jpg" style=" width:100%; margin-bottom:-85px ;    right: 60%;"> 

        <?php } ?>