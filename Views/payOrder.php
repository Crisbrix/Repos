<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../styles/payOrder.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

    <script>
        function toggleMixedPayment() {
            var paymentMethod = document.getElementById("payment-method").value;
            var mixedPaymentDiv = document.getElementById("mixed-payment");
            var cardTypeDiv = document.getElementById("card-type");
            var digitalPaymentTypeDiv = document.getElementById("digital-payment-type");
            if (paymentMethod === "Mixto") {
                mixedPaymentDiv.style.display = "block";
                cardTypeDiv.style.display = "none";
                digitalPaymentTypeDiv.style.display = "none";
            } else if (paymentMethod === "Tarjeta") {
                cardTypeDiv.style.display = "block";
                mixedPaymentDiv.style.display = "none";
                digitalPaymentTypeDiv.style.display = "none";
            } else if (paymentMethod === "Pago Digital") {
                digitalPaymentTypeDiv.style.display = "block";
                cardTypeDiv.style.display = "none";
                mixedPaymentDiv.style.display = "none";
            } else {
                mixedPaymentDiv.style.display = "none";
                cardTypeDiv.style.display = "none";
                digitalPaymentTypeDiv.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="../img/logo.png" alt="La Kamelia Logo">
            </div>
            <div class="restaurant-info">
                <h1 class="restaurant-name">La Kamelia</h1>
                <p class="restaurant-type">Restaurante</p>
            </div>
        </div>
        <div class="block order-summary">
            <table>
                <?php include("../controllers/payOrder.php");?>
            </table>
        </div>
        <div class="block input-group">
            <label for="tip">Propina(opcional):</label>
            <input type="text" id="tip" placeholder="<?php echo $totalPropina;?>">
        </div>
        <div class="block input-group">
            <label for="payment-method">Método de Pago:</label>
            <select id="payment-method" onchange="toggleMixedPayment()">
                <option>Selecciona un método</option>
                <option>Tarjeta</option>
                <option>Pago Digital</option>
                <option>Efectivo</option>
                <option>Mixto</option>
            </select>
        </div>
        <div id="card-type" class="block card-type">
            <div class="input-group">
                <label for="card-type-select">Tipo de Tarjeta:</label>
                <select id="card-type-select">
                    <option>Selecciona el tipo de tarjeta</option>
                    <option>Tarjeta de Crédito</option>
                    <option>Tarjeta de Débito</option>
                </select>
            </div>
        </div>
        <div id="digital-payment-type" class="block digital-payment-type">
            <div class="input-group">
                <label for="digital-payment-select">Tipo de Pago Digital:</label>
                <select id="digital-payment-select">
                    <option>Selecciona el tipo de pago digital</option>
                    <option>Nequi</option>
                    <option>Daviplata</option>
                    <option>Ahorro a la Mano</option>
                </select>
            </div>
        </div>
        <div id="mixed-payment" class="block mixed-payment">
            <div class="input-group">
                <label for="card-type-select-mixed">Tipo de Tarjeta:</label>
                <select id="card-type-select-mixed">
                    <option>Selecciona el tipo de tarjeta</option>
                    <option>Tarjeta de Crédito</option>
                    <option>Tarjeta de Débito</option>
                </select>
            </div>
            <div class="input-group">
                <label for="card-amount">Monto con Tarjeta:</label>
                <input type="text" id="card-amount" placeholder="Monto con Tarjeta">
            </div>
            <div class="input-group">
                <label for="digital-payment-amount">Monto con Pago Digital:</label>
                <input type="text" id="digital-payment-amount" placeholder="Monto con Pago Digital">
            </div>
            <div class="input-group">
                <label for="cash-amount">Monto en Efectivo:</label>
                <input type="text" id="cash-amount" placeholder="Monto en Efectivo">
            </div>
        </div>
        <div class="block">
            <button class="pay-button">PAGAR</button>
        </div>
    </div>
</body>
</html>