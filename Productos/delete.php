<?php
session_start();
 require_once ('../Libs/header.php');
?>
<?php
        if(!empty($_GET))
            {
                $idMenu=$_GET["idMenu"];
                //$sql="delete from Productos where iidMenu=?";
               /// $sql1="delete  from producto_categoria where idMenu=?";//Eliminado en tabla categoria
                //$cmd1=prepare_query($conexion,$sql1,[$idMenu]);
                $sql="delete  from menu where idMenu=?";//Eliminado 
                $cmd=prepare_query($conexion,$sql,[$idMenu]);
                if($cmd)
                    {
                        //echo '<script type="text/javascript">alert("Producto Eliminado Correctamente")</script>';
                        header("location: index.php");
                    }
                else
                    {
                        echo "error".$sql."-".$cmd->error;
                    }
            }
?>
<?php require_once('../Libs/footer.php');?>