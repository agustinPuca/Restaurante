<?php
session_start();
 require_once ('../Libs/header.php');
?>
<?php
        if(!empty($_GET))
            {
                $idCategoria=$_GET["idCategoria"];
                //$sql="delete from Productos where iidCategoria=?";
               /// $sql1="delete  from producto_categoria where idCategoria=?";//Eliminado en tabla categoria
                //$cmd1=prepare_query($conexion,$sql1,[$idCategoria]);
                $sql="delete  from categoria_empleado where idCategoria=?";//Eliminado 
                $cmd=prepare_query($conexion,$sql,[$idCategoria]);
                if($cmd)
                    {
                        //echo '<script type="text/javascript">alert("Producto Eliminado Correctamente")</script>';
                        header("location: indexCategoria.php");
                    }
                else
                    {
                        echo "error".$sql."-".$cmd->error;
                    }
            }
?>