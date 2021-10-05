<?php
ob_start();
?>

<?php
session_start();
require_once ('../Libs/header.php');
require_once('../Libs/barramozo.php');
date_default_timezone_set("America/Buenos_Aires");
?>
<head>
			<!-- css-->
      <link rel="stylesheet" type="text/css" href="csspedido/EstiloPedido.css">
      
</head>
  
  <?php
  if(isset($_GET))
      {
        $idPedido_Compra= $_GET['idPedido_Compra'];
		  $sql="select pc.*, i.Nombre_insumo,i.idInsumo,dp.*,ci.Nombre_Cat_Insumo from  pedido_compra pc inner join det_ped_compra dp on pc.idPedido_Compra=dp.idPedido_Compra inner join Insumos i on i.idInsumo=dp.idInsumo inner join Categoria_Insumo ci on i.idCategoria_Insumo=ci.idCategoria_Insumo where pc.idPedido_Compra=".$idPedido_Compra ;
          $Pedidos= prepare_select($conexion,$sql);
		  if($Pedidos->num_rows>0)
		  {
			  $fila=$Pedidos->fetch_assoc();
		  }
		

        if(isset($_POST["insertar"])) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
        {

            $items1    	 =($_POST["idDet_Ped_Compra"]);
            $items2		 =($Cantidad=$_POST["Cantidad"]);
            
            //Separar valores de arrays,en este caso son 6 arrays uno por cada input
            while(true)
            {
                            //recuperar los valores de los arreglos
                            $item1=current($items1);
                            $item2=current($items2);
                        //Asignarlos a variables
                        $idDet_Ped_Compra		=(($item1 !== false) ? $item1 : ", &nbsp;");
                        $Cantidad		        =(($item2 !== false) ? $item2 : ", &nbsp;");
                        
                        $sql="update Det_Ped_Compra SET Cantidad=? WHERE  idDet_Ped_Compra=? ";
                        $cmd=prepare_query($conexion,$sql,[$Cantidad,$idDet_Ped_Compra]);
                        
                            if($cmd)
                                {
                                    header('location: Detalle_mozo.php?idPedido_Compra='.$idPedido_Compra); 
                                }
                            else
                                { $msg ='No se Guardo Error:'.$sql.'</br>'.$cmd->error; }
                        //proximo valor
                        $item1= next($items1);
                        $item2= next($items2);
                        //check terminator
                        if($item1 === false && $item2 === false )break;
            }


        
    }
}
    ?>
 <!--Tabla de Insumos-->
<div class="container col-11 my-3 ">
     <div class=" text-center">
		
                <form class="form" id="form"  action="update_Detalle.php?idPedido_Compra=<?php echo $idPedido_Compra;?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="idPedido_Compra" id="idPedido_Compra" value="<?php echo $idPedido_Compra;?>">		
                                <div class="table-responsive">
                                    <input type="submit" name="insertar" value="Guardar " class="btn btn-success float-right"/>
                                    <br>
                                    <br>
                                    
                                    <nav class="navbar navbar-light justify-content-between " style="background-color:rgb(108,059,042)">
                                                    <h3 class="mx-auto text-white ">Detalle de Pedido de <?php echo $fila['Nombre_Cat_Insumo']?></h3>		
									</nav>
                        <table class="table  bg-light table-sm"  >
                                
                                        <?php 
                                        echo '<th>Detalle N°</th>';
                                        echo '<th>Insumos</th>';
                                        echo '<th>Cantidad</th>';
                                        echo '<th>Accion</th>';
                                        ?>
                                
                                    <tbody>
                                        <?php 
                                                foreach($Pedidos as $fila)
                                            {
                                                    echo '<tr>';
                                                    echo '<td ><input type="hidden" name="idDet_Ped_Compra[]" value="'.$fila['idDet_Ped_Compra'].'"/>'.$fila['idDet_Ped_Compra'].'</td>';	
                                                    echo '<td>'.$fila['Nombre_insumo'].'</td>';	
                                                    echo '<td ><input class="text-center" type="number" name="Cantidad[]" value="'.$fila['Cantidad'].'" /></td>';	
                                                    echo '<td style="white-space: nowrap;width: 1%;" ><div class="p-1 "><a href="../Pedido_Compra/Delete_Detalle.php?idPedido_Compra='. $idPedido_Compra.'&idDet_Ped_Compra='.$fila['idDet_Ped_Compra'].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt mr-2"></i>Eliminar</a></div></td>';

                                                    echo '</div> </td> </tr>';
                                            }
                                        ?>	
                                    </tbody>
                                </table>
                </form>
            </div>
     </div>
</div> 

<?php
		ob_end_flush();
?>