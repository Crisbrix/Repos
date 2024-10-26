function actualizarCronometros() {
    var cronometros = document.querySelectorAll('.cronometro'); // Cambia '.temporizador' a '.cronometro'

    cronometros.forEach(function (cronometro) {
        var tiempoPedido = new Date(cronometro.getAttribute('data-time')); // Hora del pedido desde 'data-time'
        var ahora = new Date(); // Hora actual
        var diferencia = ahora - tiempoPedido; // Diferencia en milisegundos

        // Calcular horas, minutos y segundos
        var horas = Math.floor(diferencia / (1000 * 60 * 60)); // Obtiene las horas
        var minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60)); // Obtiene los minutos
        var segundos = Math.floor((diferencia % (1000 * 60)) / 1000); // Obtiene los segundos restantes

        // Mostrar tiempo transcurrido en el formato HH:MM:SS
        cronometro.textContent = (horas < 10 ? '0' : '') + horas + ':' + (minutos < 10 ? '0' : '') + minutos + ':' + (segundos < 10 ? '0' : '') + segundos;

        // Cambiar el color del borde según el tiempo transcurrido
        var mesaContainer = cronometro.closest('.mesa-container'); // Encuentra el contenedor de la mesa
        if (diferencia < 20 * 60 * 1000) { // Menos de 20 minutos
            mesaContainer.style.borderColor = '#229A00';
        } else if (diferencia < 25 * 60 * 1000) { // Entre 20 y 25 minutos
            mesaContainer.style.borderColor = '#E5BE01';
        } else { // Más de 25 minutos
            mesaContainer.style.borderColor = '#8F0E00';
        }
    });
}

// Llamar a la función cada segundo para actualizar todos los cronómetros
setInterval(actualizarCronometros, 1000);

// Llamar una vez al cargar la página para que el cronómetro empiece inmediatamente
actualizarCronometros();
