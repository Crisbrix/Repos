const mesas = document.querySelectorAll('.mesa');

mesas.forEach(mesa => { 
    mesa.addEventListener('click', () => {
        if (mesa.style.backgroundColor == 'red') {
            mesa.style.backgroundColor = 'green';
        }else{
            mesa.style.backgroundColor = 'red';
        }
    });
});
