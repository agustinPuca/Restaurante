<?php
    session_start();

    if (isset($_POST["nSubmit"]))
    {
        $_SESSION["resultado"] = $_POST["nPrecioHidden"] * $_POST["nCantidad"];
        echo $_SESSION["resultado"];
    }
    else
    {
        unset($_SESSION["resultado"]);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onblur Input</title>
</head>
<body>
    <form action="" method="POST">
        <p>Precio $</p>
        <div id="iPrecio">200</div>
        <br>
        <p>Cantidad</p>
        <br>
        <input type="number" min="1" name="nCantidad" id="iCantidad" placeholder="Ingrese la cantidad" onblur="CalcularPrecioXCantidad(this);">
        <div id="iResultado"></div>
        <input type="submit" name="nSubmit" id="submit" value="Grabar">
    </form>



    <script>
        function CalcularPrecioXCantidad(){
            if (document.getElementById("iCantidad").value != '') {
                document.getElementById("iResultado").innerHTML = document.getElementById("iCantidad").value * document.getElementById("iPrecio").innerHTML;
            }
            else
            {
                document.getElementById("iResultado").innerHTML = 'Error';
            }            
        }        
    </script>
</body>
</html>
