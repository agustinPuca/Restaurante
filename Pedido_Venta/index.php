<?php
session_start();
require_once ('../Libs/header.php');
require_once('../Libs/barramozo.php');
date_default_timezone_set("America/Buenos_Aires");
?>
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/create.css">
    </head>
<?php
if(isset($_GET['idMesa'])){
    $idMesa=$_GET['idMesa'];
    $idPedido=$_GET['idPedido'];
    
}
?>
<?php
if(isset($_POST['seleccionar_mesa'])){
$idPedido=$_SESSION['idPedido'];
$idMesa=$_SESSION['idMesa'];
}
?>

<?php


?>

            <?php
                $sql="select * from mesas where Estado='Libre'";
                $mesas=prepare_select($conexion,$sql);
                $sql="select * from Categoria_menu ORDER BY Nombre_cat_menu ASC";
                $categorias=prepare_select($conexion,$sql);
            ?>

                          
                                                        <div class="form-inline ml-5" id="Numero_Mesa" style="position: absolute; top: 10px; right:30px;" >
                                                                 
                                                                <?php if(!empty($idPedido)){?>
                                                                    <h3 class="text-white">Mesa N° <? echo $idMesa ;?></h3>

                                                                    <?} else{ ?>   

                                                                        <h3 class="text-white my-1 mr-3" >Mesa N° </h3>
                                                                        <select class = "form-control " id="Mesa" name="Mesa" value="">
                                                                                <?php 
                                                                                    foreach($mesas as $mesa){?>
                                                                                        <option > <?php echo ' '.$mesa["idMesa"].' ('.$mesa["Capacidad"].' Personas)';?> </option>
                                                                                    <?php }?>
                                                                        </select>
                                                                        <form class="form-row  ml-2 " id="forma"  action="index.php" method="POST" enctype="multipart/form-data">
                                                                            <input type="submit" name="seleccionar_mesa" class = "btn btn-success  mx-auto " onclick="cargarpedido(this)" value="✓" >                                      
                                                                        </form> 
                                                                   <? } ?>   
                                                                                     
                                                        </div> 
                                                        
                                                        
<div class="container col-11 my-3 container-responsive">
        <? if(isset($_POST['seleccionar_mesa']) || ($_GET['idMesa'])):?>
             <a href="../Pedido_Venta/detalle_pedido.php?idPedido=<? echo $idPedido; ?>&idMesa=<? echo $idMesa; ?>&Mozo=1" style="text-decoration:none;" type="submit" name="terminar_pedido" class = "btn btn-success "> <strong>Terminar Pedido</strong> </a>
             <a href="../Pedido_Venta/delete_pedido.php?idPedido=<? echo $idPedido; ?>&idMesa=<? echo $idMesa; ?>&index=1" style="text-decoration:none;" type="submit" name="Cancelar Pedido" class = "btn btn-danger float-right"> <strong>Cancelar Pedido</strong> </a>
        <?else:?>
            <a href="../Style/indexMozo.php" style="text-decoration:none;" type="submit" name="terminar_pedido" class = "btn btn-info"> <strong><i class="fas fa-arrow-left mr-2"></i> Volver a Inicio</strong> </a>
        <? endif ?>
              <?php foreach($categorias as $categoria):?>
                <?php $nombre_categoria=$categoria['Nombre_cat_menu'];?>
                    <?php if ($nombre_categoria != "Guarniciones"): ?>     
                            <div class="titulo card  my-3 "  >
                                <a href="menu.php?idCategoria_menu=<?php echo$categoria['idCategoria_menu']; ?>&idPedido=<?php echo $idPedido; ?>&idMesa=<?php echo $idMesa; ?> " style="text-decoration:none;"><?php echo $nombre_categoria;?></a>
                            </div>
                    <?php endif; ?>
            <?php endforeach; ?>
            
</div>
<!--Pie de Pagina-->




        <script>
                function cargarpedido(){
                                
                                    n_mesa=document.getElementById("Mesa").value;
                                    agregar_pedido=1;                      
                                    numer_mesa = n_mesa.substr(0,1);
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.onreadystatechange = function() {
                                        if (this.readyState == 4 && this.status == 200) {
                                                        document.getElementById("Numero_Mesa").innerHTML = this.responseText;
                                                    }
                                                };
                                                        fd= new FormData();
                                                        fd.append('Agregar_pedido',agregar_pedido);
                                                        fd.append('n_mesa',n_mesa);
                                                        xmlhttp.open("POST", "Ajax.php", true);
                                                        xmlhttp.send(fd);
                                        }
                            
        </script>