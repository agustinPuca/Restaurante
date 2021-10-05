<?php

 require_once ('../Libs/header.php');
?>
<?php
       if(!empty($_GET["idCategoria_menu"]))
       {
           $idCategoria_menu=$_GET["idCategoria_menu"];
           $sql="delete  from Categoria_menu where idCategoria_menu=?";//Eliminado 
           $cmd=prepare_query($conexion,$sql,[$idCategoria_menu]);
           if($cmd)
               {
                   header("location: index.php");
               }
           else
               {
                   echo "error".$sql."-".$cmd->error;
               }
       }
        
?>
