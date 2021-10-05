<?php
require_once ('../Libs/header.php');
?>
<?php
            //elimino el menu que esta en productos.php que son los menu x categoria
                    if(!empty($_GET["idMenu"]))
                    {
                        $idMenu=$_GET["idMenu"];
                        $idCategoria=$_GET["idCategoria_menu"];
                        $sql="delete  from Menu where idMenu=?";//Eliminado 
                        $cmd=prepare_query($conexion,$sql,[$idMenu]);
                        if($cmd)
                            {
                                header("location: Productos.php?idCategoria_menu=".$idCategoria);
                            }
                        else
                            {
                                echo "error".$sql."-".$cmd->error;
                            }
                    }
?>