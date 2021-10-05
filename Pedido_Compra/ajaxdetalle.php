<?php
session_start();
require_once ('../Libs/conexion.php');
require_once ('../Libs/funciones.php');
?>
<?php

//inserto el pedido a la base de datos
if(!empty($_POST["Recibido1"]))
        {
            $idInsumo=  $_POST["idInsumo"];
            $idPedido_Compra=  $_POST["idPedido_Compra"];
            $Estado="Recibido"; 
            $sql="update det_ped_compra SET  Estado=? WHERE  idInsumo=? and idPedido_Compra=?";
            $datos=prepare_query($conexion,$sql,[$Estado,$idInsumo,$idPedido_Compra]);
            echo ' <button class="btn btn-success btn-sm  " onclick="Pendiente(this)" name="'.$idPedido_Compra.'"  id="'.$idInsumo.'"  ><strong>✓</strong></button>';
            
           //muestro la cantidad de insumos pendientes que tengo
            $sql1="select Count(Estado) from det_ped_compra where IdPedido_Compra=? and Estado='Pendiente'";
            $cmd=prepare_select($conexion,$sql1,[$idPedido_Compra]);
            $fila=$cmd->fetch_assoc();
            $Pendientes=$fila['Count(Estado)'];
            //saber si todos los insumos fueron Recibidos
                if ($Pendientes==0)
                    {
                        $sql="update pedido_compra SET  Estado=? WHERE   idPedido_Compra=?";
                        $datos=prepare_query($conexion,$sql,[$Estado,$idPedido_Compra]);
                    }
        }
if(isset($_POST["Pendiente1"]))
        {
            $idInsumo=  $_POST["idInsumo"];
            $idPedido_Compra=  $_POST["idPedido_Compra"];
            $Estado1="Pendiente"; 
            $sql1="update det_ped_compra SET  Estado=? WHERE  idInsumo=? and idPedido_Compra=?";
            $datos1=prepare_query($conexion,$sql1,[$Estado1,$idInsumo,$idPedido_Compra]);
            echo  '<button  class="btn btn-danger btn-sm col-4" onclick="pedidook(this)" name="'.$idPedido_Compra.'" id="'.$idInsumo.'" ><strong>Pendiente</strong></button>';
            //muestro la cantidad de insumos pendientes que tengo
            $sql1="select Count(Estado) from det_ped_compra where IdPedido_Compra=? and Estado='Pendiente'";
            $cmd=prepare_select($conexion,$sql1,[$idPedido_Compra]);
            $fila=$cmd->fetch_assoc();
            $Pendientes=$fila['Count(Estado)'];
            //saber si todos los insumos fueron Recibidos
            if ($Pendientes!=0)
            {
                $sql2="update pedido_compra SET  Estado=? WHERE   idPedido_Compra=?";
                $datos2=prepare_query($conexion,$sql2,["Pendiente",$idPedido_Compra]);
            }
        }  
?>