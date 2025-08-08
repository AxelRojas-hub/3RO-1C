var numeros = [1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,9,10,10];
var cartas = [];
var carta1 
var carta2
var cantidadAciertos = 0;
var cantidadIntentos = 0;

var finales = {
    '10' : 'Excelente memoria',
    '9' : 'Muy Buena memoria',
    '8' : 'Muy Buena Memoria',
    '7' : 'Buena Memoria. Puedes mejorar',
    '6' : 'Buena Memoria. Puedes mejorar',
 };

 function contadorPartidas(){
    var nomCoockie = "partidas";
    var vigencia = 60;
    var posCookie = document.cookie.search(nomCoockie);
    if(posCookie == -1){
        document.cookie = nomCoockie+"=1; max-age="+ vigencia;
        document.getElementById("partidas").innerHTML = "PARTIDA NRO: 1" 
    }
    else{
        var posIgual = document.cookie.indexOf("=",posCookie);
        var contador = parseInt(document.cookie.substring(posIgual+1))+1;
        document.cookie = nomCoockie+"="+contador+"; max-age="+vigencia;
        document.getElementById("numpartida").innerHTML = "PARTIDA NRO:  " +  contador;
    } 
 }

function desordenar(array) {//funcion infalible para desordenar arrays 
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

function armarTablero(){
    numeros = desordenar(numeros);
    cartas = document.getElementsByClassName("carta");
    for (let i = 0; i < cartas.length; i++) {
        cartas[i].setAttribute("onclick","chequearMatch(this);");
        cartas[i].setAttribute("id",i);  
    }

}
function chequearMatch(carta){
    
    if(carta1 == null){
        carta1 = carta.getAttribute("id");
        document.getElementById(carta.getAttribute("id")).innerHTML= numeros[carta.getAttribute("id")];
        carta.setAttribute("onclick","null");

    }else{
        carta2 =carta.getAttribute("id");
        document.getElementById(carta.getAttribute("id")).innerHTML= numeros[carta.getAttribute("id")];
        
        if(numeros[carta1]==numeros[carta2]){
            carta.setAttribute("onclick","null");
            cantidadAciertos += 1;
            document.getElementById("aciertos").innerHTML = "CANTIDAD ACIERTOS: " + cantidadAciertos;
            if(cantidadAciertos==10){
                mostrarMensajeFinal(cantidadAciertos)
            }
        }else{
            cartas[carta1].innerHTML = "0";
            cartas[carta2].innerHTML = "0";
            cartas[carta1].setAttribute("onclick","chequearMatch(this)");
            
            cantidadIntentos += 1;
            document.getElementById("intentos").innerHTML = "CANTIDAD INTENTOS: " + cantidadIntentos;
            if (cantidadIntentos==20){
                mostrarMensajeFinal(cantidadAciertos)
            }
        };
    carta1 = null;
    carta2 = null;
    };
}

function bloquearTabla(){
    cartas = document.getElementsByClassName("carta");
    for (let i = 0; i < cartas.length; i++) {
        cartas[i].setAttribute("onclick","null");
    };
};


function mostrarMensajeFinal(aciertos){
    bloquearTabla();
    if (aciertos <6){
        document.getElementById('mensajeFinal').innerHTML = "Mala memoria debes practicar mas"
    }
    else{
        document.getElementById('mensajeFinal').innerHTML = finales[aciertos];
    }
    document.getElementById('tipofin').innerHTML = "FIN DEL JUEGO";
    
}
function finalizarJuegoAbandono(){
    bloquearTabla();
    document.getElementById('mensajeFinal').innerHTML = "Que pena abandonaste";
    document.getElementById('tipofin').innerHTML = "El jugador termina el juego";
}