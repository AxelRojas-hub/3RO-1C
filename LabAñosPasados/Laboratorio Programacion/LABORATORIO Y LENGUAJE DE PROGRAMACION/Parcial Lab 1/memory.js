var carta1, carta2;
var msjFinal=document.getElementById("msjFinal");
var aciertos, intentos;
var nroPartidas=1;
var partidas=document.getElementById("partidas");
var nroAciertos=0;
var nroIntentos=0;
var valorCartas=[0,0,0,0,0,0,0,0,0,0];

function iniciar(){
    msjFinal = document.getElementById("msjFinal");
    msjFinal.innerHTML="";
    partidas = document.getElementById("partidas");
    partidas.innerHTML="Partida Nro: "+nroPartidas;
    intentos = document.getElementById("intentos");
    aciertos = document.getElementById("aciertos");
    intentos.innerHTML="INTENTOS: 0";
    aciertos.innerHTML="ACIERTOS: 0";
    var cartas = document.getElementsByClassName("carta");
    for(i in cartas){
        cartas[i].innerHTML="0";
        cartas[i].setAttribute("onClick", "seleccionarCartas(this);")
    }
    asignarCartas();
}

function asignarCartas(){
    var cartas = document.getElementsByClassName("carta");
    var ran = Math.floor(Math.random()*10)+1;
    var contadorNumeros = [0,0,0,0,0,0,0,0,0,0];
    for(i=0; i<=cartas.length; i++){
        while(contadorNumeros[ran]>=2){
            ran = Math.floor(Math.random()*10)+1;
        }
        valorCartas[i]=ran;
        contadorNumeros[ran]=contadorNumeros[ran]+1;
        ran = Math.floor(Math.random()*10)+1;
    }
}

function seleccionarCartas(carta){
    if(carta1==null){
        carta1=carta;
        carta1.innerHTML= valorCartas[carta.getAttribute("id")];
        carta1.setAttribute("onclick", "null");
    } else {
        carta2=carta;
        carta2.innerHTML=valorCartas[carta.getAttribute("id")];
        msjFinal= document.getElementById("msjFinal"); 
        aciertos= document.getElementById("aciertos");
        intentos= document.getElementById("intentos");
        if(valorCartas[carta1.getAttribute("id")] == valorCartas[carta2.getAttribute("id")]){
            carta1.innerHTML = valorCartas[carta1.getAttribute("id")];
            carta2.innerHTML = valorCartas[carta2.getAttribute("id")];
            //aca no supe como hacer para que se mostrara la segunda carta hasta que el usuario haga click de vuelta.
            carta2.setAttribute("onclick", null);
            nroAciertos=nroAciertos+1;
            aciertos.innerHTML = "ACIERTOS: "+nroAciertos;
            if(nroAciertos==10){
                terminaJuego();
            }
        } else{
            carta1.setAttribute("onclick", "seleccionarCartas(this);");
            carta1.innerHTML = 0;
            carta2.innerHTML = 0;
            nroIntentos=nroIntentos+1;
            intentos.innerHTML = "INTENTOS: "+nroIntentos;
            if(nroIntentos==20)
            {
                terminaJuego();
            }
        }
        carta1=null;
        carta2=null;
    }
}

function terminaJuego(){
    //verifica si acerto todos o llego al limite de intentos, se debe actualizar el numero de partidas.
    var cartas = document.getElementsByClassName("carta");
    for(i in cartas){
        cartas[i].setAttribute("onclick","null");
    }
    //no super como hacer que no sean clickeables cuando se termine el juego
    switch (nroAciertos){
        case 10:
            msjFinal.innerHTML = "¡¡¡EXCELENTE MEMORIA!!!";1
            break;
        case 9:
            msjFinal.innerHTML = "¡¡¡MUY BUENA MEMORIA!!!";
            break;
        case 8:
            msjFinal.innerHTML = "¡¡¡MUY BUENA MEMORIA!!!";
            break;
        case 7:
            msjFinal.innerHTML = "¡¡¡BUENA MEMORIA!!!¡¡¡PUEDES MEJORAR!!!";
            break;
        case 6:
            msjFinal.innerHTML = "¡¡¡BUENA MEMORIA!!!¡¡¡PUEDES MEJORAR!!!";
            break;
        default:
            msjFinal.innerHTML = "¡¡¡MALA MEMORIA, DEBES PRACTIAR MAS!!!";
            break;     
    }
    nroPartidas=nroPartidas+1;
}

function abandonar(){
    //muestra un mensaje para el jugador que abandono
    nroPartidas=nroPartidas+1;
    msjFinal=document.getElementById("msjFinal");
    msjFinal.innerHTML = "¡¡¡QUE PENA ABANDONASTE!!!";
}