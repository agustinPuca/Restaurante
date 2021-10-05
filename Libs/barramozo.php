
<head>
<script type="text/javascript" src="js/menuvertical.js"></script>
<style>

header {
    background:#333;
    color:#eee;
    width:100%;
}

input#abrir-cerrar {
    visibility:hidden;
    position: absolute;
    top: -9999px;
}


#menu[for="abrir-cerrar"] {
    cursor:pointer;
    padding: 1rem;
    background-color:rgb(108,059,042);
    color:#fff;
    display:inline-block;
    width:100%;

}

.cerrar {
    display:none;
}

#sidebar {
    width:0;
}

#contenido {
    margin-left:0;
}

input#abrir-cerrar:checked ~ #sidebar {
    width:300px;
}

input#abrir-cerrar:checked + menu[for="abrir-cerrar"], input#abrir-cerrar:checked ~ #contenido {
    margin-left:300px;
    transition: margin-left .4s;
}


input#abrir-cerrar:checked + menu[for="abrir-cerrar"] .cerrar {
    display:inline;
}

input#abrir-cerrar:checked + menu[for="abrir-cerrar"] .abrir {
    display:none;
}

.sidebar {
    position: fixed;
    height: 100%;
    width: 0;
    top: 0;
    left: 0;
    z-index: 1;
    background-color: rgb(199, 181, 146);
    box-shadow: 0px 0px 80px #848484;
    overflow-x: hidden;
    transition: 0.4s;
   
    box-sizing:border-box;
}

.sidebar .boton-cerrar {
    position: absolute;
    top: 0.5rem;
    right: 1rem;
    font-size: 2rem;
    display: block;
    padding: 0;
    line-height: 1.5rem;
    margin: 0;
    height: 32px;
    width: 32px;
    text-align: center;
    vertical-align: top;
}

.sidebar ul, .sidebar li{
    margin:0;
    padding:0;
    list-style:none inside;
}

.sidebar ul {
    margin: 0.4rem auto;
    display: block;
    width: 100%;
    min-width:200px;
}

.sidebar a {
    display: block;
    font-size: 125%;
   
    color: #eee;
    text-decoration: none;
    
}





.abrir-cerrar {
    color: #2E88C7;
    font-size:1rem;   
}

</style>

</head>



<input type="checkbox" id="abrir-cerrar" name="abrir-cerrar" value="">
    <label for="abrir-cerrar" id="menu"><span class="abrir"><strong>&#9776; Menú</strong></span></label>
    <div id="sidebar" class="sidebar">
        <nav id="navbar" class="navbar navbar-expand-lg  " style="background-color:rgb(108,059,042); ">
        <label for="abrir-cerrar" class="boton-cerrar" id="botonx" style="color:white;" ><span class="abrir " ><strong>&times; </strong></span></label>

                                        
        <ul >
                                                      <?php if(!isset($_SESSION["idEmpleado"])){?>
                                                       <a href="../Acceso/login.php"   class="btn btn-info btn-sm my-3"><i  class = " fas fa-sign-in-alt mr-2" > </i >Iniciar Sesión</a> 

                                                      <?php } else { ?>        
                                                              <li class="nav-item dropdown   text-white ">
                                                                         <h4 class="ml-5"> <i class="fas fa-user-circle mr-2 "></i><?php echo  $_SESSION["Login"];?></h4>
                                                              </li>
                                                            
                                                              
                                                       <?php } ?>
                                              </ul>
                                          
        </nav>
        
    <ul class="menu " >
            <li><a class="dropdown-item text-dark" href="../style/indexMozo.php"><strong>&nbsp;&nbsp;&nbsp;<i class="fas fa-home text-warning mr-2"></i>Inicio</strong></a></li>
            <li><a class="dropdown-item text-dark" href="../Pedido_Venta/index.php"><strong>&nbsp;&nbsp;&nbsp;<i class="fas fa-plus-circle  text-success mr-2"></i>Agregar Pedido    </strong></a></li>
            <li><a class="dropdown-item text-dark" href="../Pedido_Venta/indexPedidos.php"><strong>&nbsp;&nbsp;&nbsp;<i class="fas fa-tasks text-primary mr-2 "></i>Historial Ped. de Venta</strong></a></li>
            <div class="dropdown-divider "></div>
            <li><a class="dropdown-item text-dark" href="../Mesas/Mesas_Disp.php"><strong>&nbsp;&nbsp;&nbsp;<i class="fas fa-vector-square mr-2"></i>Mesas Disponibles </strong></a></li>
            <li><a class="dropdown-item text-dark" href="../Mesas/create.php"><strong>&nbsp;&nbsp;&nbsp;<i class="fas fa-plus-circle text-success mr-2"></i>Agregar Mesa      </strong></a></li>
            <div class="dropdown-divider  "></div>
            <li><a class="dropdown-item text-dark" href="../Pedido_Compra/CreatePed_mozo.php"><strong>&nbsp;&nbsp;&nbsp;<i class="fas fa-plus-circle text-success mr-2"></i>Agr.Pedido a Proveedor  </strong></a></li>
            <li><a class="dropdown-item text-dark" href="../Pedido_Compra/index_mozo.php"><strong>&nbsp;&nbsp;&nbsp;<i class="fas fa-tasks text-primary mr-2"></i>Pedidos a proveedor </strong></a></li>
            <br>
            <div class="dropdown-divider "></div>
                                    <a class="dropdown-item text-center text-dark" href="../Acceso/loginout.php"><i class="fas fa-sign-out-alt text-danger mr-2"></i><strong>Cerrar Sesion </strong> </a>
                                                            </div>        </ul>
    </div>


     

