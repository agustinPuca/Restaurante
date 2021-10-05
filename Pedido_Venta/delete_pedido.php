<?php
session_start();
 require_once ('../Libs/header.php');

?>
<?php
    if(!empty($_GET["idPedido"]))
        {
            $idPedido= $_GET["idPedido"];
            $idMesa=$_GET["idMesa"];
            $index=$_GET["index"];
            $sql="delete  from pedidos_ventas where idPedido_Venta=? and idMesa=?";
            $datos=prepare_query($conexion,$sql,[$idPedido,$idMesa]);
            //libero la mesa
            $sql2="update mesas SET Estado=? WHERE   idMesa=?";
            $Mesa=prepare_query($conexion,$sql2,['Libre',$idMesa]);
            if($Mesa)
                    {
                        if(isset($index)){
                             header("location: index.php");
                        }
                        else{
                            header("location: indexPedidos.php");
                        }
                    }
            
        }