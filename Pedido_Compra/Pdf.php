<?php
session_start();
require_once ('../Libs/conexion.php');
require_once ('../Libs/funciones.php');
date_default_timezone_set("America/Buenos_Aires");
?>
  <?php
  if(isset($_GET))
      {
        $idPedido_Compra= $_GET['idPedido_Compra'];
          $sql="select pc.*, i.*,dp.Cantidad,dp.descripcion,p.* from  pedido_compra pc inner join det_ped_compra dp on pc.idPedido_Compra=dp.idPedido_Compra inner join insumos i on i.idinsumo=dp.idinsumo inner join proveedores p on p.idProveedor=pc.idProveedor where pc.idPedido_Compra=".$idPedido_Compra;
          $Pedidos= prepare_select($conexion,$sql);
          if($Pedidos->num_rows>0)
              {
                $Npedido=$Pedidos->fetch_assoc();
              }
      }
    ?>

<?php
 ob_start();?>
 <table width="650px" align="center" cellspacing="0" cellpadding="5">
    <tr>
        <td align="left" >
         <strong style="font-size: 25pt;"> El Legado</strong>
         <br>
          Juan B.justo N°380
          <br>
          Rosario de Lerma, Salta, 4405
          <br>
          Telefono: (0387)156-186960
        </td>
        <td align="right" valign="top">
          <font color="#8F8FBD">
            <strong style="font-size: 25pt;">ORDEN DE PEDIDO </strong >
            <br>
          <font color="black">
            <strong >Fecha:</strong> <?php echo $Npedido['Fecha_Pedido'] ;?> 
            <br>
            <strong >Orden de Pedido #: </strong> <?php echo $Npedido['idPedido_Compra'] ;?> 
            
    </td>
    </tr>

    <tr>
        <td align="left" valign="top">
         <strong style="font-size:20px;background-color:#8F8FBD;color:white;">&nbsp;&nbsp; VENDEDOR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
         <br>
          El Legado
         <br>
          Juan B.justo N°380
          <br>
          Rosario de Lerma, Salta, 4405
          <br>
          (0387)156-186960
          <br>
          Ellegado88@gmail.com
       </td>      
      
        <td align="right" valign="top"  >
        <strong style="font-size:20px;background-color:#8F8FBD;color:white;">&nbsp;&nbsp; ENVIAR A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
         <br>
          <? echo $Npedido['RazonSocial']?>
          <br>
          <? echo $Npedido['Cuit']?>
          <br>
          <? echo $Npedido['Direccion']?> 
          <br>
          <? echo $Npedido['Localidad']?> 
          <br>
          <? echo $Npedido['Telefono_Fijo']?> 
        </td>
    </tr>
    
</table>
<br>

 <table width="500px" border="1" align="center" cellspacing="0" cellpadding="5">
                <tr valign="bottom" align="center" >
                        <td bgcolor="#8F8FBD"><font color="white">Articulo #</td>
                        <td bgcolor="#8F8FBD"><font color="white">Insumo</td>
                        <td bgcolor="#8F8FBD"><font color="white">Descripcion</td>
                        <td bgcolor="#8F8FBD"><font color="white">Cantidad</td>
                </tr>
                          <?php foreach($Pedidos as $fila)
                          {?>
                          
                              <tr valign="bottom" align="center">
                                      <td><?php echo $fila['idInsumo'];?></td>
                                      <td><?php echo $fila['Nombre_Insumo'];?></td>
                                      <td><?php echo $fila['descripcion'];?></td>
                                      <td><?php echo $fila['Cantidad'];?></td>						
                              </tr>
                                      <?php } ?>
</table>
<!--Pie de Pagina-->
<br>
<br>
<br>
<br>
<br>
<br>

<a  href="../Styles/index.php" ><img src="../Imagenes/logofooter1.png" style=" width:130px;  ;"> </a>

<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "ejemplo.pdf";
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>