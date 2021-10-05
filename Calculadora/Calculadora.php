<?php
session_start();
require_once ('../Libs/Funciones.php');
require_once ('../Libs/Conexion.php');
date_default_timezone_set("America/Buenos_Aires");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Hoja de Estilo Css-->
    <link rel="stylesheet" href="estiloCalculadora.css">
    <!-- archivo Javascript-->
    <script src="calculadora.js"></script>
    <title>Document</title>
</head>

<body>
    <header>
        <h1>Calculadora - Taller III  </h1>
    </header>
    <main>
        <table class="Ccalculadora" >
            <tr>
                <td colspan="4"> <span class="subt"  id="subpantalla" >0</span> </td>
                
            </tr>
            <tr>
                <td colspan="4"> <span class="sub"  id="pantallaprincipal"  >0</span> </td>
                
            </tr>
            <tr>
                <td colspan="1"><button  class="del" onclick="del(1)" >CE</button> </td>
                <td colspan="1"><button   class="del" onclick="del(2)">C</button> </td>
                <td colspan="1"><button   class="del" onclick="del(3)"><i class="fas fa-backspace"></i></button> </td>
                <td><button class="operand"  onclick="operacion('/')">÷</button> </td> 
            <tr>
                <td><button class="sig"  onclick="especial('1')" >Xˣ</button> </td>
                <td><button class="sig"  onclick="especial('2')" >%</button> </td>
                <td><button class="sig"  onclick="especial('3')" >√</button> </td>
                <td><button class="operand"  onclick="especial('4')" >∛</button> </td>
            </tr>
            <tr>
                <td><button class="num" onclick="numero('7')" id="siete">7</button> </td>
                <td><button class="num" onclick="numero('8')" id="ocho"> 8 </button> </td>
                <td><button class="num" onclick="numero('9')" id="nueve"> 9 </button> </td>
                <td><button class="operand" onclick="operacion('*')" id="mutltiplicar">x</button> </td> 
            </tr>
            <tr>
                <td><button class="num" onclick="numero('4')" id="cuatro">4</button> </td>
                <td><button class="num" onclick="numero('5')" id="cinco">5</button> </td>
                <td><button class="num" onclick="numero('6')" id="seis">6</button> </td>
                <td><button class="operand" onclick="operacion('-')" id="restar">-</button> </td>
            </tr>
            <tr>
                <td><button class="num" onclick="numero('1')" id="uno">1</button></td>
                <td><button class="num" onclick="numero('2')" id="dos">2</button></td>
                <td><button class="num" onclick="numero('3')" id="tres">3</button></td>
                <td><button class="operand" onclick="operacion('+')" id="sumar">+</button> </td>
            
            </tr>
            <tr>
                <td><button class="sig" onclick="operacion('.')" id="coma">,</button> </td>
                <td><button class="num" onclick="numero(0)" id="cero" >0</button> </td>
                <td><button class="sig" onclick="neg('-')" id="sumar">±</button> 
                </td><td rowspan="2"><button class="result"  onclick="resulta()" id="result">=</button> </td>
               

            </tr>
            <tr>
                <td><button class="sig" onclick="boh('8')" id="uno">oct</button></td>
                <td><button class="sig" onclick="boh('16')" id="dos">hex</button></td>
                <td><button class="sig" onclick="boh('2')" id="tres">b</button></td>
                
            </tr>
        </table>
    </main>
    
</body>
