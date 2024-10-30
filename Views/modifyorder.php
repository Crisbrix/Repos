<?php
       include("../controllers/modifyorderc.php")
       ?>
       <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modificar</title>
            <link rel="stylesheet" href="../styles/modifyorder.css">
            <link rel="stylesheet" href="../styles/fontStyles.css">
            <link rel="stylesheet" href="../styles/styles.css">

            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Lilita+One&display=swap" rel="stylesheet">
        </head>
        <body>
        <nav>
            <ul>        
                <li><p class="tittle">REPOS</p></li>
                <li class="dropdown">
                <a href="starters.php" class="dropbtn">Menú</a>
                    <div class="dropdown-content">
                        <a href="returncontrol.php">Devoluciones</a>
                        <a href="home.php">Salir</a>
                    </div>
                </li>
            </ul>
        </nav>
            <div class="container">
                <div class="left">
                    <div class="sup">
                        <div class="imagen"><img src="../img/logo.jpg" alt="NO SE ENCONTRO"></div>
                        <div class="textos">
                            <h1>La Kamelia</h1>
                            <h2>Restaurante</h2>
                        </div><!-- Fin textos -->
                    </div><!-- Fin sup -->
                    <div class="mid">
                    <h3> <?php 
                // Asegúrate de que $pedidos no esté vacío y muestra el primer pedido
                if (!empty($pedidos)) {
                    echo htmlspecialchars($pedidos[0]['nombre']); 
                } else {
                    echo "No";
                }
                ?><br></h3>
                    </div><!--fin mid-->
                    <div class="low">
                        <h4>Pedido</h4>
                        <ul>
                        <?php 
                    if (!empty($pedidos)) {
                        foreach ($pedidos as $pedido) {
                            echo "<li>" . htmlspecialchars($pedido['producto']) . "............................... " . htmlspecialchars($pedido['cantidad']) . "</li>";
                        }
                    } else {
                        echo "<li>No hay productos disponibles.</li>";
                    }
                    ?>
                        </ul>
                    </div>
                </div><!-- Fin left -->
                <div class="right">
                <div class="botones">    
    <button id="agregarBtn">Agregar</button>
    <form action="deleteOrder.php" method="post" style="flex-grow: 1; display: flex; justify-content: center;">
        <button type="submit" name="Eliminar" class="button Eliminar" 
            onclick="return confirm('¿Estás seguro de que desea eliminar el pedido?');">
            Eliminar
        </button>
    </form>
    <form action="bill.php" method="post" style="flex-grow: 1; display: flex; justify-content: center;">
        <button type="submit" name="cerrarcuenta" class="button cerrarcuenta" 
            onclick="return confirm('¿Estás seguro de que desea cerrar cuenta?');">
            Cerrar cuenta
        </button>
    </form>
</div> <!--fin botones-->

<div id="nuevosBotones" style="display: none; margin-top: 2%;">
    <button id="fuertesBtn">Fuertes</button>
    <button id="entradasBtn">Entradas</button>
    <button id="bebidasBtn">Bebidas</button>
</div><!--fin nuevosbotones-->
<div class="opcionesup">
    <div class="cuadrobotones">
        <div id="platosFuertes" style="display: none; margin-top: 2%; gap: 2%;margin-bottom: 2%;">
            <!-- Botones de platos fuertes -->
        </div>
        <div id="entradas" style="display: none; margin-top: 2%; gap: 2%; margin-bottom: 2%;">
            <!-- Los botones de entradas se generarán aquí -->
        </div>
        <div id="bebidas" style="display: none; margin-top: 2%; gap: 2%; margin-bottom: 2%;">
            <!-- Los botones de bebidas se generarán aquí -->
        </div><!--fin cuadrosbotones-->
    </div><!--fin opcionesupbotones-->
    <div class="opciones">
    <button class="btn" id="decreaseBtn">-</button>
    <span class="quantity">0</span>
    <button class="btn" id="increaseBtn">+</button>
    <input type="text" name="comentario" id="nom" placeholder="comentario"><br>
    <form action="modifyorder.php" method="post">
    <input type="hidden" name="platoSeleccionado" id="platoSeleccionado">
    <input type="hidden" name="cantidadSeleccionada" id="cantidadSeleccionada">
    <input type="hidden" name="comentario" id="comentarioOculto">
    <button type="submit" class="enviar">Enviar</button>
</form>
    </div> 
</div>
                </div><!--fin right-->
            </div>
            <script>
document.getElementById('agregarBtn').addEventListener('click', function() {
    var nuevosBotones = document.getElementById('nuevosBotones');
    if (nuevosBotones.style.display === 'none') {
        nuevosBotones.style.display = 'block'; 
    } else {
        nuevosBotones.style.display = 'none'; 
    }
});

// Función para ocultar todos los divs
function ocultarTodosDivs() {
    document.getElementById('platosFuertes').style.display = 'none';
    document.getElementById('entradas').style.display = 'none';
    document.getElementById('bebidas').style.display = 'none';
}

// Botón de Platos Fuertes
function seleccionarBoton(boton, tipo) {
    const botones = document.querySelectorAll(`#${tipo} button`);
    botones.forEach(b => {
        b.classList.remove('selected');
        b.style.backgroundColor = ''; // Resetear el color de fondo
        b.style.color = ''; // Resetear el color del texto
    });

    boton.classList.add('selected');
    boton.style.backgroundColor = '#4CAF50'; // Color de fondo al botón seleccionado
    boton.style.color = 'white'; // Color del texto al botón seleccionado
    document.getElementById('platoSeleccionado').value = boton.textContent; 
}

// Botón de Platos Fuertes
document.getElementById('fuertesBtn').addEventListener('click', function() {
    ocultarTodosDivs();
    var platosFuertesDiv = document.getElementById('platosFuertes');
    platosFuertesDiv.innerHTML = '';

    <?php foreach ($platosFuertes as $plato): ?>
        platosFuertesDiv.innerHTML += `<button style="margin-right: 10px;" onclick="seleccionarBoton(this)"><?php echo $plato; ?></button>`;
    <?php endforeach; ?>

    platosFuertesDiv.style.display = 'block';
});

// Botón de Entradas
document.getElementById('entradasBtn').addEventListener('click', function() {
    ocultarTodosDivs(); // Ocultar todos los divs antes de mostrar el seleccionado
    var entradasDiv = document.getElementById('entradas');
    entradasDiv.innerHTML = ''; // Limpiar el contenido previo

    // Agregar botones de ejemplo para entradas
    <?php foreach ($entradas as $entrada): ?>
        entradasDiv.innerHTML += `<button style="margin-right: 10px;" onclick="seleccionarBoton(this, 'entradas')"><?php echo $entrada; ?></button>`;
    <?php endforeach; ?>

    // Mostrar el div de entradas
    entradasDiv.style.display = 'block'; 
});

// Botón de Bebidas
document.getElementById('bebidasBtn').addEventListener('click', function() {
    ocultarTodosDivs(); // Ocultar todos los divs antes de mostrar el seleccionado
    var bebidasDiv = document.getElementById('bebidas');
    bebidasDiv.innerHTML = ''; // Limpiar el contenido previo

    // Agregar botones de ejemplo para bebidas
    <?php foreach ($bebidas as $bebida): ?>
        bebidasDiv.innerHTML += `<button style="margin-right: 10px;" onclick="seleccionarBoton(this, 'bebidas')"><?php echo $bebida; ?></button>`;
    <?php endforeach; ?>    

    // Mostrar el div de bebidas
    bebidasDiv.style.display = 'block'; 
    
});
let quantity = 0;
const quantitySpan = document.querySelector('.quantity');
const increaseBtn = document.getElementById('increaseBtn');
const decreaseBtn = document.getElementById('decreaseBtn');
const platoSeleccionadoInput = document.getElementById('platoSeleccionado');
const cantidadSeleccionadaInput = document.getElementById('cantidadSeleccionada');

// Actualizar cantidad
increaseBtn.addEventListener('click', () => {
    quantity++;
    quantitySpan.textContent = quantity;
});

decreaseBtn.addEventListener('click', () => {
    if (quantity > 0) {
        quantity--;
        quantitySpan.textContent = quantity;
    }
});

// Seleccionar el plato y añadir la clase .selected
function seleccionarBoton(boton) {
    const botones = document.querySelectorAll('#platosFuertes button');
    botones.forEach(b => b.classList.remove('selected'));
    boton.classList.add('selected');
    platoSeleccionadoInput.value = boton.textContent; // Guardar el nombre del plato
}

// Capturar la cantidad y el plato al hacer clic en "Enviar"
document.querySelector('.enviar').addEventListener('click', () => {
    cantidadSeleccionadaInput.value = quantity; // Guardar la cantidad
    const comentarioInput = document.getElementById('nom'); // Cambia a 'nom'
    document.getElementById('comentarioOculto').value = comentarioInput.value; // Guardar el comentario en el campo oculto
});
</script>
        </body>
        </html>
