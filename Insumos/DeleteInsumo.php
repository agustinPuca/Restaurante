<?php
session_start();
 require_once ('../Libs/header.php');
?>
<?php
        if(!empty($_GET))
            {
                $idInsumo=$_GET["idInsumo"];
                //$sql="delete from Productos where iIdProducto=?";
               /// $sql1="delete  from producto_categoria where idProducto=?";//Eliminado en tabla categoria
                //$cmd1=prepare_query($conexion,$sql1,[$idProducto]);
                $sql="delete  from insumos where idInsumo=?";//Eliminado 
                $cmd=prepare_query($conexion,$sql,[$idInsumo]);
                if($cmd)
                    {
                        //echo '<script type="text/javascript">alert("Producto Eliminado Correctamente")</script>';
                        header("location: indexInsumo.php");
                    }
                else
                    {
                        echo "error".$sql."-".$cmd->error;
                    }
            }
?>
<?php require_once('../Libs/footer.php');?>