<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 - Facturación con IVA</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="contenedor">
        <h1>Ejercicio 2</h1>
        <h2 class="subtitulo">Facturación con IVA, Descuento Condicional y Unidades Múltiples</h2>

        <p class="descripcion">
            Emita la factura correspondiente a la compra de unidades de un artículo.
            Se aplica un IVA del 12 % sobre el subtotal. Si el monto total con IVA
            supera los 150 $, se aplica un descuento del 15 % al monto final a cancelar.
        </p>

        <form method="POST" action="ejercicio2_factura.php">

            <fieldset>
                <legend>Datos de la venta</legend>

                <label for="descripcion">Descripción del artículo:</label>
                <input type="text" name="descripcion" id="descripcion" maxlength="80" required>

                <label for="cantidad">Cantidad adquirida:</label>
                <input type="number" name="cantidad" id="cantidad" step="any" min="1" value="3" required>

                <label for="precio_unitario">Precio unitario de venta ($):</label>
                <input type="number" name="precio_unitario" id="precio_unitario" step="any" min="0.01" value="40" required>
            </fieldset>

            <button type="submit">Generar factura</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $descripcion = $_POST["descripcion"];
            $cantidad = (float) $_POST["cantidad"];
            $precio_unitario = (float) $_POST["precio_unitario"];

            $porcentaje_iva = 12;
            $porcentaje_descuento = 15;
            $limite_descuento = 150;

            $subtotal = $cantidad * $precio_unitario;
            $valor_iva = $subtotal * ($porcentaje_iva / 100);
            $total_con_iva = $subtotal + $valor_iva;

            $aplica_descuento = $total_con_iva > $limite_descuento;

            if ($aplica_descuento) {
                $monto_descuento = $total_con_iva * ($porcentaje_descuento / 100);
            } else {
                $monto_descuento = 0;
            }

            $total_neto = $total_con_iva - $monto_descuento;
        ?>
            <div class="resultado">
                <h3>Factura</h3>

                <p class="subtitulo-resultado">Detalle de la venta</p>
                <table>
                    <tr>
                        <th>Artículo</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>
                    </tr>
                    <tr>
                        <td><?php echo htmlspecialchars($descripcion); ?></td>
                        <td><?php echo number_format($cantidad, 0, ',', '.'); ?></td>
                        <td>$ <?php echo number_format($precio_unitario, 2, ',', '.'); ?></td>
                        <td>$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                    </tr>
                </table>

                <p class="subtitulo-resultado">Desglose de los importes</p>
                <table>
                    <tr>
                        <th>Concepto</th>
                        <th>Porcentaje</th>
                        <th>Monto</th>
                    </tr>
                    <tr>
                        <td>Subtotal (precio base)</td>
                        <td>-</td>
                        <td>$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td>IVA</td>
                        <td><?php echo $porcentaje_iva; ?> %</td>
                        <td>$ <?php echo number_format($valor_iva, 2, ',', '.'); ?></td>
                    </tr>
                    <tr class="fila-total">
                        <td colspan="2">Total con IVA</td>
                        <td>$ <?php echo number_format($total_con_iva, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td>Descuento por monto mayor a $ <?php echo number_format($limite_descuento, 0, ',', '.'); ?></td>
                        <td><?php echo $porcentaje_descuento; ?> %</td>
                        <td>
                            <?php if ($aplica_descuento) { ?>
                                $ -<?php echo number_format($monto_descuento, 2, ',', '.'); ?>
                            <?php } else { ?>
                                No aplica
                            <?php } ?>
                        </td>
                    </tr>
                </table>

                <?php if ($aplica_descuento) { ?>
                    <p class="nota-aplica">Se aplicó el descuento del <?php echo $porcentaje_descuento; ?> % porque el total con IVA ($ <?php echo number_format($total_con_iva, 2, ',', '.'); ?>) supera los $ <?php echo number_format($limite_descuento, 0, ',', '.'); ?>.</p>
                <?php } else { ?>
                    <p class="nota-no-aplica">No se aplicó descuento porque el total con IVA ($ <?php echo number_format($total_con_iva, 2, ',', '.'); ?>) no supera los $ <?php echo number_format($limite_descuento, 0, ',', '.'); ?>.</p>
                <?php } ?>

                <p class="neto">Monto total neto a pagar: $ <?php echo number_format($total_neto, 2, ',', '.'); ?></p>
            </div>
        <?php
        }
        ?>
    </div>
</body>
</html>