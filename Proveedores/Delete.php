<?php
session_start();
 require_once ('../Libs/header.php');
?>
<?php
        if(!empty($_GET))
            {
                $idProveedor=$_GET["idProveedor"];
                $sql="delete  from proveedores where idProveedor=?";//Eliminado 
                $cmd=prepare_query($conexion,$sql,[$idProveedor]);
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