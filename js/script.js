// Obtener todas las mesas
const mesas = document.querySelectorAll('.mesa');

// Función para alternar el estado activo/inactivo de una mesa
mesas.forEach(mesa => {
    mesa.addEventListener('click', () => {
        // Alternar la clase 'activa'
        if (mesa.style.backgroundColor == 'red') {
            mesa.style.backgroundColor = 'green'; // Mesa inactiva (roja)
        } else {
            mesa.style.backgroundColor = 'red'; // Mesa activa (verde)
        }
    });
});
