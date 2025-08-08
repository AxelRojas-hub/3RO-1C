// Generar número aleatorio entre 1 y 100
const randomNumber = Math.floor(Math.random() * 100) + 1;
console.log(randomNumber); 

var restantes = 10; // Intentos restantes
var bandera = false; // Bandera 

document.getElementById('botonAdivinar').addEventListener('click', function() {
    if (!bandera && restantes > 0) {
        var guessInput = document.getElementById('numInput');
        var guess = parseInt(guessInput.value);

        if (guess >= 1 && guess <= 100) {
            if (guess === randomNumber) {
                mostrarMensaje(`¡Felicidades! Has adivinado el número ${randomNumber}.`);
                bandera = true;
            } else {
                restantes--;
                if (restantes === 0) {
                    mostrarMensaje(`¡Se acabaron los intentos! El número era ${randomNumber}.`);
                    bandera = true;
                } else {
                    var mensaje = guess < randomNumber ? '¡Demasiado bajo!' : '¡Demasiado alto!';
                    mostrarMensaje(`${mensaje} Intentos restantes: ${restantes}`);
                }
            }
        } else {
            mostrarMensaje('Por favor, ingresa un número del 1 al 100.');
        }

        guessInput.value = ''; // Limpiar el campo de entrada
    }
});

document.getElementById('giveUpButton').addEventListener('click', function() {
    mostrarMensaje(`¡Te has rendido! El número era ${randomNumber}.`);
    bandera = true;
});

function mostrarMensaje(mensaje) {
    document.getElementById('mensaje').textContent = mensaje;
}
