<?php
session_start();
include("conexion.php");

//Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table'];

    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT mesa_id, numero_mesa FROM mesas WHERE mesa_id = '$table'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //Inicio de sesión exitoso
        $row = $result->fetch_assoc();
        $mesa = $row['mesa_id'];

        //Almacenar el ID del usuario en la sesión
        $_SESSION['mesaId'] = $mesa;

        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'add':
                    header('Location: adicion.php');
                    break;
                case 'edit':
                    header('Location: modifyorder.php');
                    break;
                case 'close':
                    header('Location: bill.php');
                    break;
                case 'view':
                    header('Location: ver_pedido.php');
                    break;
                default:
                    echo "Acción no válida.";
            }
        }
        exit();
    } else {
        //Credenciales incorrectas
        echo "<style>.err{ 
            width: 70%;
            text-align: center;
            height: 4vh;
            margin-left: 15%;
            background-color: red;
            border-radius:5px;
            color:white;}
            </style><p class='err'>Mesa no encontrada</p>";
    }
}

//Cerrar la conexión a la base de datos
$conn->close();

?>