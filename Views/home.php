<?php
    session_start();

    include("../controllers/conexion.php");

    if (isset($_SESSION['userid'])) {
        $userId = $_SESSION['userid'];  
    } else {
        header("Location: ../index.php");
    } 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RePOS</title>
    <link rel="stylesheet" href="../styles/home.css">
    <link rel="stylesheet" href="../styles/fontStyles.css">
</head>
<body>
    <!-- Menú de Navegación -->
    <nav>
        <ul>
            <li><a><?php
            // Consulta SQL para verificar las credenciales del usuario
            $sql = "SELECT nombre, rol FROM usuarios WHERE usuario_id = '$userId'";
            $result = $conn->query($sql);

            $row = $result->fetch_assoc();
            $name = ucfirst($row["nombre"]);
            $rol = ucfirst($row["rol"]);
            if ($result->num_rows > 0) {
                echo $rol;
            }
            
        ?></a></li>
            <li><a class="link" href="#funcion1">Adicion Pedido</a></li>
            <li><a class="link" href="#funcion2">Modificar Pedido</a></li>
            <li><a class="link" href="table.php">Cerrar Cuenta</a></li>
            <li><a class="link" href="#funcion4">Ver pedido</a></li>
            <li><a class="link" href="../controllers/logout.php">Cerrar Sesión</a></li>
            <?php 
                echo $name;
            ?>
        </ul>
    </nav>
    <!-- Sección de Mesas -->
    <div class="container">
        <!-- Alcón Derecho -->
        <div class="section" id="alcon-derecho">
            <h2>Alcón Derecho</h2>
            <div class="mesas">
                <!-- Generar mesas del 1 al 18 -->
                <div class="mesa" id="mesa1">1</div>
                <div class="mesa" id="mesa2">2</div>
                <div class="mesa" id="mesa3">3</div>
                <div class="mesa" id="mesa4">4</div>
                <div class="mesa" id="mesa5">5</div>
                <div class="mesa" id="mesa6">6</div>
                <div class="mesa" id="mesa7">7</div>
                <div class="mesa" id="mesa8">8</div>
                <div class="mesa" id="mesa9">9</div>
                <div class="mesa" id="mesa10">10</div>
                <div class="mesa" id="mesa11">11</div>
                <div class="mesa" id="mesa12">12</div>
                <div class="mesa" id="mesa13">13</div>
                <div class="mesa" id="mesa14">14</div>
                <div class="mesa" id="mesa15">15</div>
                <div class="mesa" id="mesa16">16</div>
                <div class="mesa" id="mesa17">17</div>
                <div class="mesa" id="mesa18">18</div>
            </div>
        </div>

        <!-- Alcón Izquierdo -->
        <div class="section" id="alcon-izquierdo">
            <h2>Alcón Izquierdo</h2>
            <div class="mesas">
                <!-- Generar mesas del 21 al 47 -->
                <div class="mesa" id="mesa21">21</div>
                <div class="mesa" id="mesa22">22</div>
                <div class="mesa" id="mesa23">23</div>
                <div class="mesa" id="mesa24">24</div>
                <div class="mesa" id="mesa25">25</div>
                <div class="mesa" id="mesa26">26</div>
                <div class="mesa" id="mesa27">27</div>
                <div class="mesa" id="mesa28">28</div>
                <div class="mesa" id="mesa29">29</div>
                <div class="mesa" id="mesa30">30</div>
                <div class="mesa" id="mesa31">31</div>
                <div class="mesa" id="mesa32">32</div>
                <div class="mesa" id="mesa33">33</div>
                <div class="mesa" id="mesa34">34</div>
                <div class="mesa" id="mesa35">35</div>
                <div class="mesa" id="mesa36">36</div>
                <div class="mesa" id="mesa37">37</div>
                <div class="mesa" id="mesa38">38</div>
                <div class="mesa" id="mesa39">39</div>
                <div class="mesa" id="mesa40">40</div>
                <div class="mesa" id="mesa41">41</div>
                <div class="mesa" id="mesa42">42</div>
                <div class="mesa" id="mesa43">43</div>
                <div class="mesa" id="mesa44">44</div>
                <div class="mesa" id="mesa45">45</div>
                <div class="mesa" id="mesa46">46</div>
                <div class="mesa" id="mesa47">47</div>
            </div>
        </div>

        <!-- Tercera Sección -->
        <div class="section" id="tercera-seccion">
            <h2>Palco</h2>
            <div class="mesas">
                <!-- Generar mesas del 51 al 70 -->
                <div class="mesa" id="mesa51">51</div>
                <div class="mesa" id="mesa52">52</div>
                <div class="mesa" id="mesa53">53</div>
                <div class="mesa" id="mesa54">54</div>
                <div class="mesa" id="mesa55">55</div>
                <div class="mesa" id="mesa56">56</div>
                <div class="mesa" id="mesa57">57</div>
                <div class="mesa" id="mesa58">58</div>
                <div class="mesa" id="mesa59">59</div>
                <div class="mesa" id="mesa60">60</div>
                <div class="mesa" id="mesa61">61</div>
                <div class="mesa" id="mesa62">62</div>
                <div class="mesa" id="mesa63">63</div>
                <div class="mesa" id="mesa64">64</div>
                <div class="mesa" id="mesa65">65</div>
                <div class="mesa" id="mesa66">66</div>
                <div class="mesa" id="mesa67">67</div>
                <div class="mesa" id="mesa68">68</div>
                <div class="mesa" id="mesa69">69</div>
                <div class="mesa" id="mesa70">70</div>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>
