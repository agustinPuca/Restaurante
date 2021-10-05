<?php
session_start();
 require_once ('../Libs/header.php');
?>
<?php
        if(!empty($_GET['idDet_Ped_Compra']))
            {
                $idDet_Ped_Compra=$_GET["idDet_Ped_Compra"];
                $idPedido_Compra=$_GET["idPedido_Compra"];
                //$sql="delete from Productos where iidDet_Ped_Compra=?";
               /// $sql1="delete  from producto_categoria where idDet_Ped_Compra=?";//Eliminado en tabla categoria
                //$cmd1=prepare_query($conexion,$sql1,[$idDet_Ped_Compra]);
                $sql="delete  from det_ped_compra where idDet_Ped_Compra=?";//Eliminado 
                $cmd=prepare_query($conexion,$sql,[$idDet_Ped_Compra]);
                if($cmd)
                    {
                        header("location: update_Detalle.php?idPedido_Compra=".$idPedido_Compra);
        
                    }
                else
                    {
                        echo "error".$sql."-".$cmd->error;
                    }
            }
?>
