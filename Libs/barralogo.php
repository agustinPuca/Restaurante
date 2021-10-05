<?

		 $Nombre_Cat=$_SESSION['Nombre_Categoria'];//Categoria del empleado
		 
?>
<nav id="navbar" class="navbar p-0 navbar-expand-lg  " style="background-color:rgb(108,059,042); z-index: 2;">
<div class="container ">
								<h2 class="text-white col-2 "><? echo $Nombre_Cat; ?></h2>
								<a class="navbar-brand  mx-auto position-static d-none d-lg-block " href="../Style/index<?php echo $Nombre_Cat; ?>.php" ><img src="../Imagenes/logorest.png" style=" width:140px; margin-bottom:-85px ;   position: relative;  right: 60%;"> </a>
								
</div>
</nav>