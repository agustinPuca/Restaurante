<?php
session_start();
 require_once ('../Libs/header.php');
?>
<?php
        if(!empty($_GET))
            {
                $idEmpleado=$_GET["idEmpleado"];
                //$sql="delete from Productos where iidEmpleado=?";
               /// $sql1="delete  from producto_categoria where idEmpleado=?";//Eliminado en tabla categoria
                //$cmd1=prepare_query($conexion,$sql1,[$idEmpleado]);
                $sql="delete  from Empleados where idEmpleado=?";//Eliminado 
                $cmd=prepare_query($conexion,$sql,[$idEmpleado]);
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