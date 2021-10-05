<?php
session_start();
require_once ('../Libs/conexion.php');
require_once ('../Libs/funciones.php');
?>
<?php
//inserto el pedido a la base de datos
if(isset($_POST["Agregar_pedido"]))
        {
            $idEmpleado=      $_SESSION['idEmpleado'];
            $n_mesa=          $_POST["n_mesa"];
            $Estado='Abierta'; 
            //de la variable$n_mesa solo quiero el primer valor que es el id de la mesa
            $sql="INSERT INTO pedidos_ventas(Fecha_hora,idEmpleado,Estado,Total,idMesa) values(NOW(),?,'Abierta',?,?)";
            $cmd=prepare_query($conexion,$sql,[$idEmpleado,000, $n_mesa]);
            $sql="update mesas SET  Estado=? WHERE  idMesa=?";
            $datos=prepare_query($conexion,$sql,['Abierta', $n_mesa]);
            $num_mesa=substr($n_mesa,0,1);
            $idPedido= $cmd->insert_id;
           
                $_SESSION['idPedido']=$idPedido;
                $_SESSION['idMesa']=$num_mesa;
               echo '<h3 class="text-white"> Mesa N° '.$num_mesa.'</h3>';
        }  

 
if(isset($_POST["agregar"])){
    $idMenu=                $_POST["idMenu"];
    $idPedido=              $_POST['idPedido'];
    $Cantidad=              $_POST["Cantidad"];
    $Precio=                $_POST["Precio"];
    $Guarnicion=            $_POST["Guarnicion"];
    $Estado='Pendiente';
    $Descripcion_pedido=    $_POST["Descripcion"];
    $Precio_num = substr($Precio, 1);//saco el signo pesos
    $Subtotal=  $Cantidad * $Precio_num ; 
    $sql="INSERT INTO detalle_pedido(idMenu,Cantidad,Subtotal,idPedidos_Venta,Precio,Estado,Descripcion_Pedido,Guarnicion) values(?,?,?,?,?,?,?,?)";
    $cmd=prepare_query($conexion,$sql,[$idMenu,$Cantidad,$Subtotal,$idPedido,$Precio_num,$Estado,$Descripcion_pedido,$Guarnicion]);
    echo ' <input type="submit" name="'.$idMenu.'" class = "btn btn-danger btn-sm mx-auto col-6" onclick="borrarmenu(this)" value="X" >';
    //sumo los subtotales y cargo el total
    $sql1="select SUM(Subtotal) as sumtotal from detalle_pedido where idPedidos_Venta=".$idPedido;//as sumtotal es el alias que le doy a la columna con el resultado de mi consulta
    $cmd1=prepare_select($conexion,$sql1);
    $fila=$cmd1->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
    $total=$fila['sumtotal']; 
    //Este es el valor que calcule en la consulta
    $sql2="update pedidos_ventas set Total=? where  idPedido_Venta=". $idPedido;
    $cmd3=prepare_query($conexion,$sql2,[$total]);

}
if(isset($_POST["borrar"])){
        $idMenu=                $_POST["idMenu"];
        $idPedido=              $_POST['idPedido'];
        $sql="delete  from detalle_pedido where idPedidos_Venta=? and idMenu=?";//Eliminado 
        $cmd=prepare_query($conexion,$sql,[$idPedido,$idMenu]);
        echo '<input type="submit" name="'.$idMenu.'" class = "btn btn-success btn-sm mx-auto col-6" onclick="cargarmenu(this)" value="✓" >';

    }
    

?>

