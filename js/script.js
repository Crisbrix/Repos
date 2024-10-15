// Obtener todas las mesas
const mesas = document.querySelectorAll('.mesa');

// Función para alternar el estado activo/inactivo de una mesa
mesas.forEach(mesa => {
    mesa.addEventListener('click', () => {
        // Alternar la clase 'activa'
        if (mesa.style.backgroundColor == 'green') {
            mesa.style.backgroundColor = 'red'; // Mesa inactiva (roja)
        } else {
            mesa.style.backgroundColor = 'green'; // Mesa activa (verde)
        }
    });
});
