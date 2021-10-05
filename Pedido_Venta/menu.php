<?php
session_start();
require_once ('../Libs/header.php');
require_once('../Libs/barramozo.php');
date_default_timezone_set("America/Buenos_Aires");
?>
<?php
	if(!empty($_GET))
    {
        $idCategoria=$_GET['idCategoria_menu'];
        $idPedido=$_GET['idPedido'];
        $idMesa=$_GET['idMesa'];
        $sql="SELECT m.idMenu,m.codigo_Menu,m.Nombre_Menu,m.Descripcion_Menu,m.Precio_menu from menu m inner join  producto_categoria pc on m.idMenu=pc.idMenu  where pc.idCategoria_menu=? ORDER BY m.Nombre_Menu ASC";
        $datos= prepare_select($conexion,$sql,[$idCategoria]);    
    }
 else{   
        if(!empty($_POST)) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
        {
            $idCategoria=$_POST['idCategoria_menu']; 
            $idPedido=$_POST['idPedido'];
            $menuselect=$_POST['boton'];
            $sql="select m.idMenu,m.codigo_Menu,m.Nombre_Menu,m.Descripcion_Menu,m.Precio_menu from menu m inner join Imagenes i on m.idImagen=i.idImagen inner join producto_categoria pc on m.idMenu=pc.idMenu  where pc.idCategoria_menu=".$idCategoria;
            $datos= prepare_select($conexion,$sql);
        }
    }
//Recupero nombre de la categoria seleccionada
    $sql="SELECT Nombre_cat_menu FROM categoria_menu WHERE idCategoria_menu=?";
    $cmd=prepare_select($conexion,$sql,[$idCategoria]);
    $fila=$cmd->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
    $Nombre_Cat=$fila['Nombre_cat_menu'];
    //Mostrar guarniciones
    $sql1="SELECT m.Nombre_Menu FROM  menu m inner join producto_categoria pc on m.idMenu=pc.idMenu  inner join categoria_menu cm on pc.idCategoria_Menu=cm.idCategoria_menu where cm.Nombre_cat_menu='Guarniciones' ORDER BY m.Nombre_Menu ASC";
    $guarniciones=prepare_select($conexion,$sql1);
    
?>	
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/menu.css">
	</head>
    <!--Tabla de menus-->
    <h4 class="ml-5 text-white" style="position: absolute; top: 11px; right:30px;"><?php echo $Nombre_Cat;?></h4></th>
<div class="todo col-11 mx-auto ">
                    

                    <input type="hidden" name="idCategoria_menu" id="idCategoria_menu" value=<?php echo $idCategoria;?>>
                    <input type="hidden" name="idPedido" id="idPedido" value=<?php echo $idPedido;?>>
                
				    <div class="table-responsive">  
                    <!--boton para ir a categorias-->
                        <a href="index.php?idMesa=<?php echo $idMesa; ?>&idPedido=<?php echo $idPedido; ?> " class="btn btn-success   "><i class="fas fa-arrow-left mr-2"></i> Categorias de Menu</a>
          
                                <table class="table table-striped bg-light " id="table" >
                                    <!--TIULO--->
                                        
                                        <thead  class="text-center text-white" style="background-color:rgb(108,059,042)" >
                                                <th>Menú</th>
                                                <th>Precio</th>
                                                <th>Descripcion</th>
                                                <th>Cantidad</th>
                                                <th>Guarnición</th>
                                                <th>Acciones</th>
                                        </thead >
                                        <tbody>
                                            <?php  foreach($datos as $fila){ ?>
                                                       <tr>
                                                        
                                                           <input type="hidden" name="<?php echo $fila['idMenu'];?>" id="idMenu<?php echo $fila['idMenu'];?>" value="<?php echo $fila['idMenu'];?>"/>
                                                                <td class="text-center" style="white-space: nowrap;width: 4%; text-transform: uppercase;"><strong><?php echo $fila['Nombre_Menu']; ?></strong></td>	
                                                                <td  style="white-space: nowrap;width: 2%;" id="Precio<?php echo $fila['idMenu'];?>" name="Precio">$<?php echo $fila['Precio_menu']; ?></td>
                                                                
                                                                    <td> <input type="text"  class ="form-control form-control " name="Descripcion_pedido" id="descripcion<?php echo $fila['idMenu'];?>"  ><? echo $fila['Descripcion_Pedido'];?></td>	 
                                                                
                                                                <td style="white-space: nowrap;width: 4%;">  
                                                                    <select class = " form-control  "  name="Cantidad" id="Cantidad<?php echo $fila['idMenu'];?>">
                                                                        <option >1</option>
                                                                        <option >2</option>
                                                                        <option >3</option>
                                                                        <option >4</option>
                                                                        <option >5</option>
                                                                        <option >6</option>
                                                                        <option >7</option>
                                                                </select> 	
                                                            </td>
                                                                    <td> 
                                                                                <select class = " form-control   "  name="Guarniciones" id="Guarniciones<?php echo $fila['idMenu'];?>">
                                                                                        <?php foreach($guarniciones as $guarnicion){ ?>
                                                                                            <option > <?php echo $guarnicion["Nombre_Menu"]; ?> </option>
                                                                                    <?php }?>
                                                                                    
                                                                                </select> 
                                                                    </td>
                                                                <td class=" text-center" id="boton<?php echo $fila['idMenu'];?>" style="white-space: nowrap;width: 4%;">
                                                                <?php //recupero el id de la consulta anteriro de carritoscompra
                                                                  
                                                                  $idMenu=$fila["idMenu"];
                                                                  //consulto en la bd si tal producto existe en la tabla det carrito donde el idPedido$idPedidoscompra es del usuario actual
                                                                  $sql="SELECT  CASE idMenu WHEN ? THEN 1 ELSE 0 END AS Existe FROM detalle_pedido WHERE  idPedidos_Venta=? and idMenu=".$idMenu;              
                                                                  $carritos=prepare_select($conexion,$sql,[$idMenu,$idPedido]);  
                                                                  $fila=$carritos->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
                                                                  $bool=$fila['Existe'];
                                                              
                                                                      if($bool==0){?>
                                                                           <input type="submit" name="<?php echo $idMenu;?>" class = "btn btn-success btn-sm mx-auto col-6" onclick="cargarmenu(this)" value="✓" >
                                                                  <? } else{ ?>
                                                                            <input type="submit" name="<?php echo $idMenu;?>" class = "btn btn-danger btn-sm mx-auto col-6" onclick="borrarmenu(this)" value="X" >   
                                                                    <? } ?>
                                                                </td>
                                                    </tr>
                                              <?php } ?>	
                                        </tbody>
                                                 
                                        
                                    </table>
                        
                    
			    </div>
                	
         </div> 

<script>
    function cargarmenu(str){
                               
                                idMenu=document.getElementById("idMenu"+ str.name).value;
                                Precio=document.getElementById("Precio"+ str.name).innerHTML;
                                Descripcion=document.getElementById("descripcion"+ str.name).value;
                                Cantidad=document.getElementById("Cantidad"+ str.name).value;
                                Guarnicion=document.getElementById("Guarniciones"+ str.name).value;
                                idPedido=document.getElementById("idPedido").value;
                                agregar=1;
                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById("boton"+ str.name).innerHTML = this.responseText;
                                    }
                                };
                                        fd= new FormData();
                                        fd.append('agregar',agregar);
                                        fd.append('idMenu',idMenu);
                                        fd.append('Precio',Precio);
                                        fd.append('Descripcion',Descripcion);
                                        fd.append('Cantidad',Cantidad);
                                        fd.append('Guarnicion',Guarnicion);
                                        fd.append('idPedido',idPedido);
                                        xmlhttp.open("POST", "Ajax.php", true);
                                        xmlhttp.send(fd);
    }
    function borrarmenu(str){
        
        idMenu=document.getElementById("idMenu"+ str.name).value;
        idPedido=document.getElementById("idPedido").value;
        borrar=1;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("boton"+ str.name).innerHTML = this.responseText;
            }
        };
                fd= new FormData();
                fd.append('idMenu',idMenu);
                fd.append('idPedido',idPedido);
                fd.append('borrar',borrar);
                xmlhttp.open("POST", "Ajax.php", true);
                xmlhttp.send(fd);
}
    </script>
                   
			
									
	<!--Pie de Pagina-->
