//ingreso de numeros         
         function numero(valor)
                    {
                        if(pantallaprincipal.textContent=='0')
                        {
                               pantallaprincipal.textContent =  valor;
                        }
                        else{ 
                        pantallaprincipal.textContent = pantallaprincipal.textContent  + valor;}
                    }
//FUNCIONES DE OPERACIONES
        function operacion(valor)
                    {   x=pantallaprincipal.textContent;
                        can=x.length;
                        br=x.substr(can-1,can); //describir último caracter
                        if(br==valor) 
                        { }
                        else{
                         pantallaprincipal.textContent = pantallaprincipal.textContent  + valor;
                        }
                    }

                            
        function especial(valor) 
                    { 
                        // 1 Potencia
                        // 2 Porcentaje
                        // 3 Raiz cuadrada
                        // 4 Raiz cubica
                        x=pantallaprincipal.textContent;
                        can=x.length;
                        br=x.substr(can-1,can) ;//describir último caracter
                        var valor=Number(valor);
                        switch (valor) {
                                        case 1: pantallaprincipal.textContent= x + '**'; break;
                                        case 2: 
                                                r=x/100;
                                                pantallaprincipal.textContent=r;
                                                pantallaprincipal.textContent= pantallaprincipal.textContent + '*'
                                                ; break;
                                        case 3: pantallaprincipal.textContent=Math.sqrt(x); break;
                                        case 4: pantallaprincipal.textContent=Math.pow(x,1/3); break;
                        }
                    }
//Convertir numero en binario, Oct, Hex
        function boh(valor)
                    {
                        var num=Number(pantallaprincipal.textContent)
                        pantallaprincipal.textContent= num.toString(valor) ;
                        var valor=Number(valor)
                        switch (valor) {
                                            case 2: subpantalla.textContent=num +' a Binario '; break;
                                            case 8: subpantalla.textContent=num +' a octal '; break;
                                            case 16: subpantalla.textContent=num +' a Hexadecimal'; break;
                                        }                        
                    }
//Signo negativo
         function neg(valor)
                    {
                        if(pantallaprincipal.textContent==0) {
                                    pantallaprincipal.textContent;
                                }
                            else{
                        pantallaprincipal.textContent ="-"+ pantallaprincipal.textContent  ;
                                }
                    }
//Borrado de pantallaprincipal
        function del(valor)
                {
                    // 1=borra borra pantallaprincipal de una pantallaprincipal
                    // 2=borra pantallaprincipals de las dos pantallaprincipals
                    // 3=borra ultimo valor escrito
                    x=pantallaprincipal.textContent;
                    var valor=Number(valor)
                        switch (valor) {
                                        case 1: pantallaprincipal.textContent =  0; break;
                                        case 2: subpantalla.textContent=0 , pantallaprincipal.textContent=0; break;
                                        case 3: 
                                                can=x.length; //cantidad de caracteres que hay en pantalla
                                                br=x.substr(can-1,can) // último caracter
                                                x=x.substr(0,can-1) //quitar el ultimo caracter
                                                    if (x=="") {x="0";} //0 si se borra todo
                                                pantallaprincipal.textContent=x; 
                                            ; break;
                                            }
                }
//pantallaprincipal de Operacion
        function resulta()
                {subpantalla.textContent = pantallaprincipal.textContent
                    result = eval(pantallaprincipal.textContent); 
                    pantallaprincipal.textContent= result;
                }
          
                
