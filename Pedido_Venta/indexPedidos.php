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
<?php
    $sql="select * from pedidos_ventas ";
    $pedidos=prepare_select($conexion,$sql)
    
?>	
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/create.css">
    </head>
	<h3 class="ml-5 text-white" style="position: absolute; top: 11px; right:30px;">Historial de Pedidos</h3></th>
<div class="todo col-11 mx-auto ">
                    

				    <div class="table-responsive">  
                    <!--boton para ir a categorias-->
                   <? if($_SESSION['Nombre_Categoria']=='Mozo'):?>
                        <a href="../Style/IndexMozo.php" class="btn btn-success   "><i class="fas fa-arrow-left mr-2"></i> Menu</a>
                    <? else: ?>
                        <a href="../Style/IndexCajero.php" class="btn btn-success   "><i class="fas fa-arrow-left mr-2"></i>Inicio</a>

                    <? endif ?>
                                <table class="table table-striped bg-light " id="table" >
                                    <!--TIULO--->
                                        
                                        <thead  class="text-center text-white" style="background-color:rgb(108,059,042)" >
                                                <th>N° Mesa</th>
                                                <th>Fecha/Hs</th>
                                                <th>Estado</th>
                                                <th>Total</th>
                                                <th>Opciones</th>
                                        </thead >
                                        <tbody class="table-sm">
                                            <?php  foreach($pedidos as $pedido){ 
                                                $datetime=$pedido['Fecha_Hora'];
                                                $tiempo=substr($datetime,10);
                                                ?>
                                                       <tr>
                                                        
                                                           <input type="hidden"  name="idPedido_Venta" id="idPedido_Venta" value="<?php echo $pedido['idPedido_Venta'];?>"/>
                                                                <td class="text-center" style="white-space: nowrap;width: 2%; text-transform: uppercase;"><strong><?php echo $pedido['idMesa']; ?></strong></td>
                                                                <td class="text-center" style="white-space: nowrap;width: 2%; text-transform: uppercase;"><strong><?php echo $pedido['Fecha_Hora']; ?></strong></td>
	
                                                                <!--<td class="text-center " style="white-space: nowrap;width: 2%; text-transform: uppercase;"  ><h5 id="crono<?php echo $pedido['idPedido_Venta'];?>">00:00:00</h5>
                                                                <input type="button" name="<?php echo $pedido['idPedido_Venta'];?>" value="Empezar echo $pedido['idPedido_Venta'];" id="boton  echo $pedido['idPedido_Venta'];" onclick="empezarDetener(this);"></td>-->

                                                                <td  class="text-center text-danger " style="white-space: nowrap;width: 2%;" id="Estado" name="Estado"><strong><?php echo $pedido['Estado']; ?></strong></td>                       
                                                                <td  class="text-center " style="white-space: nowrap;width: 1%;" id="Total" name="Total"><?php echo $pedido['Total']; ?></td>

                                                                <td class=" text-center" id="boton" style="white-space: nowrap;width: 4%;">
                                                                <a  href="detalle_pedido.php?idPedido=<?php echo $pedido['idPedido_Venta'];?>&idMesa=<?php echo $pedido['idMesa']; ?>" class = "btn btn-info btn-sm mx-auto col-5">Detalle</a> 
                                                                </td>
                                                    </tr>
                                              <?php } ?>	
                                        </tbody>
                                                 
                                        
                                    </table>
                        
                    
			    </div>
                	
         </div> 
         <script>
  
 var inicio=0;
    var timeout=0;
    function empezarDetener(elemento)
    {  
        idPedido=elemento.name;
        if(timeout==0)
        {
            // empezar el cronometro
 
            elemento.value="Detener"+idPedido;
 
            // Obtenemos el valor actual
            inicio=new Date().getTime();
            
            // Guardamos el valor inicial en la base de datos del navegador
            localStorage.setItem("inicio",inicio);
            localStorage.setItem("idPedido",idPedido);
            // iniciamos el proceso
            funcionando(idPedido);
        }else{
            // detemer el cronometro
 
            elemento.value="Empezar"+idPedido;
            clearTimeout(timeout);
 
            // Eliminamos el valor inicial guardado
            localStorage.removeItem("inicio");
            localStorage.removeItem("idPedido");
            timeout=0;
        }
    }
 
    function funcionando(idPedido)
    {
       
        // obteneos la fecha actual
        var actual = new Date().getTime();
 
        // obtenemos la diferencia entre la fecha actual y la de inicio
        var diff=new Date(actual-inicio);
 
        // mostramos la diferencia entre la fecha actual y la inicial
        var result=LeadingZero(diff.getUTCHours())+":"+LeadingZero(diff.getUTCMinutes())+":"+LeadingZero(diff.getUTCSeconds());
        document.getElementById('crono'+idPedido).innerHTML = result;
 
        // Indicamos que se ejecute esta función nuevamente dentro de 1 segundo
        timeout=setTimeout("funcionando(idPedido)",1000);
    }
 
    /* Funcion que pone un 0 delante de un valor si es necesario */
    function LeadingZero(Time)
    {
        return (Time < 10) ? "0" + Time : + Time;
    }
 
    window.onload=function()
    { 
        if(localStorage.getItem("inicio"+9)!=null)
        {  
            // Si al iniciar el navegador, la variable inicio que se guarda
            // en la base de datos del navegador tiene valor, cargamos el valor
            // y iniciamos el proceso.
            inicio=localStorage.getItem("inicio"+9);
            document.getElementById("boton"+9).value="Detener"+idPedido;
            funcionando();
        }
    }
    </script>