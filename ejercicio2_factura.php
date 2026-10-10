<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
</head>
<body>

    <h1>Ejercicio 2</h1>
    <p>Facturación de una compra. El IVA es de 12 % sobre el subtotal y,
    si el total con IVA supera los 150 $, se aplica un descuento de 15 %.</p>
    <hr>

    <form method="post" action="">
        Descripción: <input type="text" name="descripcion"><br><br>
        Cantidad: <input type="number" name="cantidad"><br><br>
        Precio unitario: <input type="number" name="precio" step="0.01"><br><br>
        <input type="submit" name="generar" value="Generar factura">
    </form>

    <?php
    if (isset($_POST["generar"])) {

        $descripcion = $_POST["descripcion"];
        $cantidad = $_POST["cantidad"];
        $precio = $_POST["precio"];

        $subtotal = $cantidad * $precio;
        $iva = $subtotal * 12 / 100;
        $total_con_iva = $subtotal + $iva;

        if ($total_con_iva > 150) {
            $descuento = $total_con_iva * 15 / 100;
        } else {
            $descuento = 0;
        }

        $total_neto = $total_con_iva - $descuento;

        echo "<hr>";
        echo "<h3>Factura</h3>";
        echo "Artículo: $descripcion <br>";
        echo "Cantidad: $cantidad <br>";
        echo "Precio unitario: $ " . $precio . " <br><br>";

        echo "Subtotal: $ " . round($subtotal, 2) . " <br>";
        echo "IVA (12 %): $ " . round($iva, 2) . " <br>";
        echo "Total con IVA: $ " . round($total_con_iva, 2) . " <br><br>";

        if ($total_con_iva > 150) {
            echo "Descuento (15 %): -$ " . round($descuento, 2) . " <br>";
        } else {
            echo "Descuento: No aplica, el total no supera los 150 $ <br>";
        }

        echo "<h2>Monto total neto a pagar: $ " . round($total_neto, 2) . "</h2>";
    }
    ?>

</body>
</html>