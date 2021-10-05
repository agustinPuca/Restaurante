<?php
session_start();
require_once ('../Libs/header.php');
require_once ('../Libs/barramozo.php');
?>
<head>
<link rel="stylesheet" type="text/css" href="Css/Mozo.css">
</head>
<?php //cuando vuelvo al menu principal elimino las variables guardadas en session cerrando el pedido
      if(isset($_GET))
      {
      $_SESSION['idPedido']="";
        $_SESSION['idMesa']="";
    }
?>
<?php
    if(!empty($_SESSION['idEmpleado']))
        {?>
        <div class="container col-11 my-3 ">
            
            <div class="titulo card  my-3 "  >
                <a href="../Pedido_Venta/index.php" style="text-decoration:none;"><i class="fas fa-plus-circle text-white mr-2"></i>Agregar Pedido</a>
            </div>
            <div class="titulo card  my-3  "  >
            <a href="../Mesas/Mesas_Disp.php" style="text-decoration:none; "><i class="fas fa-vector-square mr-2"></i> Mesas Disponibles</a>
            </div>
            <div class="titulo card  my-3  "  >
            <a href="../Mesas/create.php" style="text-decoration:none; "><i class="fas fa-plus-circle text-white mr-2"></i> Agregar Mesas</a>
            </div>
            <div class="titulo card  my-3  "  >
            <a href="../Pedido_Compra/CreatePed_mozo.php" style="text-decoration:none; "><i class="fas fa-plus-circle text-white mr-2"></i>Agregar Pedido a Proveedor</a>
            </div>
            <div class="titulo card  my-3  "  >
            <a href="../Pedido_Compra/index_mozo.php" style="text-decoration:none; "><i class="fas fa-tasks mr-2"></i>Ver Pedidos a Proveedor</a>
            </div>
            <div class="titulo card  my-3  "  >
                <a href="../Pedido_Venta/indexPedidos.php" style="text-decoration:none;"><i class="fas fa-tasks mr-2"></i>Historial Pedidos Ventas</a>
            </div>
        </div>
      <?  }
?>
 