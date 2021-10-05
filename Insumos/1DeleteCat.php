<?php
session_start();
 require_once ('../Libs/header.php');
?>
<?php
        if(!empty($_GET))
            {
                $idCategoria_Insumo=$_GET["idCategoria_Insumo"];
                $sql="delete  from Categoria_insumo where idCategoria_Insumo=?";//Eliminado 
                $cmd=prepare_query($conexion,$sql,[$idCategoria_Insumo]);
                if($cmd)
                    {
                        header("location: 1indexCat.php");
                    }
                else
                    {
                        echo "error".$sql."-".$cmd->error;
                    }
            }
?>
