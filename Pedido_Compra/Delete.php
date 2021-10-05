<?php
session_start();
 require_once ('../Libs/header.php');
?>
<?php
        if(!empty($_GET))
            {
                $idPedido_Compra=$_GET["idPedido_Compra"];
                //$sql="delete from Productos where iidPedido_Compra=?";
               /// $sql1="delete  from producto_categoria where idPedido_Compra=?";//Eliminado en tabla categoria
                //$cmd1=prepare_query($conexion,$sql1,[$idPedido_Compra]);
                $sql="delete  from pedido_compra where idPedido_Compra=?";//Eliminado 
                $cmd=prepare_query($conexion,$sql,[$idPedido_Compra]);
                if($cmd)
                    {
                            header("location: index_mozo.php");        
                    }
                else
                    {
                        echo "error".$sql."-".$cmd->error;
                    }
            }
?>
