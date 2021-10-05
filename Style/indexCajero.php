<?php
session_start();
 require_once ('../Libs/header.php');
 require_once('../Libs/MenuCajero.php');
?>
<br>
  <div class="container col-11 ">
        <div class="row row-cols-1 my-5 row-cols-md-6  ">
<?php

    $sql1="SELECT pv.Total,m.idmesa,m.estado FROM pedidos_ventas pv INNER JOIN mesas m ON pv.idMesa=m.idMesa";
    $sql="select * from mesas";
    $mesas=prepare_select($conexion,$sql);
?>
               <!--<h2><a href="../Calculadora/Calculadora.php" style="text-decoration:none; " style="position: absolute; top: -105px; right:-20px; "><i class="fas fa-calculator text-white " ></i></a></h2>-->
 
               <?php  foreach($mesas as $mesa): ?>
             
    <div class="state "><!--div para marcar desde donde puedo pasar el mouse -->
                    <div class="col mb-3   ">
                        <!--cambio la tarjeta de color rojo si la mesa esta ocupada-->
                        <?php 
                                $idMesa=$mesa['idMesa'];
                                $sql1="SELECT * FROM pedidos_ventas where idMesa=?";
                                $cmd=prepare_select($conexion,$sql1,[$idMesa]);
                                if($cmd){
                                    $fila=$cmd->fetch_assoc();
                                }
                        switch ($mesa['Estado']){
                            case 'Abierta':
                                    echo '<div class="card h-100 bg-success text-white">';
                                break;
                            case 'Facturar': //Cuando se emite el tiket elestado de la mesa es amarrillo
                                    echo  '<div class="card h-100 bg-warning text-white">';
                                break;
                            case 'Facturada': 
                                    echo '<div class="card h-100 bg-danger text-white">';
                                break;
                            case 'Libre':         
                                    echo '<div class="card h-100 ">';
                                break;
                          }?>
                                                <h3 class="card-title mx-auto"><?php echo $idMesa;?></h3>
                                                <!--ocultar descripcion cuando el mouse no este sobre-->
                                                        <div class="mx-3">
                                                             <p class="card-text d-none d-lg-block " ><span class="state-full"><?php echo $mesa['sDescripcion'];?></span></p>
                                                        </div>

                                            <div class="card-footer ">
                                                    <div class="input-group  col-12">
                                                    <? if ($mesa['Estado']!='Libre'):?>
                                                            <!--boton de ventana desplegable de detalle de la mesa-->
                                                                        <button type="button" class="btn btn-light btn-sm col-9 mx-auto" data-toggle="modal" data-name="<?php echo $fila['idPedido_Venta'];?>" data-target="#exampleModal" data-whatever="<?php echo $idMesa;?>">Detalle</button>
                                                                                <div class="modal fade bd-example-modal-lg my-5 " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header " style="background-color:rgb(108,059,042)">
                                                                                                <h3 class="modal-title text-white " id="exampleModalLabel" style=" position: relative;left: 40%;"></h3>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true" class="text-white">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="body" id="ModalBody">
                                                                                            
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                        <!--boton de ventana desplegable de cobro-->                          
                                                    <? else: ?>
                                                        <a href="#" type="submit"   id="añadir"    class="btn btn-dark  btn-sm col-7 mx-auto">Reservar</a>                             
                                                    <? endif ?>
                                                        
                                                    </div>
                                            </div>
                                </div>
                    </div> 
                </div>
    <?php endforeach ?>                
                    <!-- Button trigger modal -->



            </div> 
<script>
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)// Botón que activó el modal
            var recipient = button.data('whatever') // Extraer información de datos- * atributos         
            var idPedido= button.data('name')
            // AJAX
                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById("ModalBody").innerHTML = this.responseText;
                                    }
                                };
                                        fd= new FormData();
                                        fd.append('idPedido',idPedido);
                                        fd.append('idMesa',recipient);
                                        xmlhttp.open("POST", "AjaxCajero.php", true);
                                        xmlhttp.send(fd);
            // Actualiza el contenido del modal. Usaremos jQuery aquí, pero podría usar una biblioteca de enlace de datos u otros métodos en su lugar.
            var modal = $(this)
            modal.find('.modal-title').text('Mesa N°' + recipient)
            modal.find('.modal-body input').val(recipient)
            })
           
           
            function accion(str)
                {
                    idDetalle_Venta=str.name;
                    accion=str.value;
                    idPedido=str.id;
                     var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("boton"+str.name).innerHTML = this.responseText;
                        }
                    };
                        fd= new FormData();
                        fd.append('idDetalle_Venta',idDetalle_Venta);
                        fd.append('accion',accion);
                        fd.append('idPedido1',idPedido);
                        xmlhttp.open("POST", "AjaxCajero.php", true);
                        xmlhttp.send(fd);
                }
                
</script>