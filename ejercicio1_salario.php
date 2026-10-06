<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Salario Quincenal</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="contenedor">
        <h1>Ejercicio 1</h1>
        <h2 class="subtitulo">Cálculo de Salario Quincenal con Deducciones Variables</h2>

        <p class="descripcion">
            Calcule el sueldo quincenal de un trabajador a partir de las horas trabajadas
            en tres turnos y sus datos personales. Tarifas por hora:
            Diurna = 675 Bs., Vespertina = 700 Bs., Nocturna = 956.23 Bs.
        </p>

        <form method="POST" action="ejercicio1_salario.php">

            <fieldset>
                <legend>Datos personales del trabajador</legend>

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" maxlength="60" required>

                <label for="cedula">Cédula:</label>
                <input type="text" name="cedula" id="cedula" maxlength="10" required>
            </fieldset>

            <fieldset>
                <legend>Horas trabajadas en el quincenio</legend>

                <label for="horas_diurna">Horas diurnas:</label>
                <input type="number" name="horas_diurna" id="horas_diurna" step="any" min="0" value="40" required>

                <label for="horas_vespertina">Horas vespertinas:</label>
                <input type="number" name="horas_vespertina" id="horas_vespertina" step="any" min="0" value="40" required>

                <label for="horas_nocturna">Horas nocturnas:</label>
                <input type="number" name="horas_nocturna" id="horas_nocturna" step="any" min="0" value="20" required>
            </fieldset>

            <button type="submit">Calcular salario quincenal</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $nombre = $_POST["nombre"];
            $cedula = $_POST["cedula"];
            $horas_diurna = (float) $_POST["horas_diurna"];
            $horas_vespertina = (float) $_POST["horas_vespertina"];
            $horas_nocturna = (float) $_POST["horas_nocturna"];

            $tarifa_diurna = 675.00;
            $tarifa_vespertina = 700.00;
            $tarifa_nocturna = 956.23;

            $sueldo_diurno = $horas_diurna * $tarifa_diurna;
            $sueldo_vespertino = $horas_vespertina * $tarifa_vespertina;
            $sueldo_nocturno = $horas_nocturna * $tarifa_nocturna;

            $sueldo_bruto = $sueldo_diurno + $sueldo_vespertino + $sueldo_nocturno;

            if ($sueldo_bruto < 85000) {
                $porcentaje_ahorro = 0.10;
                $porcentaje_seguro = 0.15;
                $tramo = "Menor a 85.000 Bs.";
            } elseif ($sueldo_bruto <= 150000) {
                $porcentaje_ahorro = 0.15;
                $porcentaje_seguro = 0.20;
                $tramo = "Entre 85.000 Bs. y 150.000 Bs.";
            } else {
                $porcentaje_ahorro = 0.30;
                $porcentaje_seguro = 0.25;
                $tramo = "Mayor a 150.000 Bs.";
            }

            $ahorro_habitacional = $sueldo_bruto * ($porcentaje_ahorro / 100);
            $seguro_social = $sueldo_bruto * ($porcentaje_seguro / 100);

            $total_deducciones = $ahorro_habitacional + $seguro_social;
            $sueldo_neto = $sueldo_bruto - $total_deducciones;
        ?>
            <div class="resultado">
                <h3>Resultado</h3>

                <p class="subtitulo-resultado">Datos personales del trabajador</p>
                <table>
                    <tr>
                        <th>Nombre</th>
                        <td><?php echo htmlspecialchars($nombre); ?></td>
                    </tr>
                    <tr>
                        <th>Cédula</th>
                        <td><?php echo htmlspecialchars($cedula); ?></td>
                    </tr>
                </table>

                <p class="subtitulo-resultado">Sueldo bruto según turno</p>
                <table>
                    <tr>
                        <th>Turno</th>
                        <th>Horas</th>
                        <th>Tarifa por hora</th>
                        <th>Subtotal</th>
                    </tr>
                    <tr>
                        <td>Diurno</td>
                        <td><?php echo number_format($horas_diurna, 2, ',', '.'); ?></td>
                        <td><?php echo number_format($tarifa_diurna, 2, ',', '.'); ?> Bs.</td>
                        <td><?php echo number_format($sueldo_diurno, 2, ',', '.'); ?> Bs.</td>
                    </tr>
                    <tr>
                        <td>Vespertino</td>
                        <td><?php echo number_format($horas_vespertina, 2, ',', '.'); ?></td>
                        <td><?php echo number_format($tarifa_vespertina, 2, ',', '.'); ?> Bs.</td>
                        <td><?php echo number_format($sueldo_vespertino, 2, ',', '.'); ?> Bs.</td>
                    </tr>
                    <tr>
                        <td>Nocturno</td>
                        <td><?php echo number_format($horas_nocturna, 2, ',', '.'); ?></td>
                        <td><?php echo number_format($tarifa_nocturna, 2, ',', '.'); ?> Bs.</td>
                        <td><?php echo number_format($sueldo_nocturno, 2, ',', '.'); ?> Bs.</td>
                    </tr>
                    <tr class="fila-total">
                        <td colspan="3">Sueldo quincenal bruto</td>
                        <td><?php echo number_format($sueldo_bruto, 2, ',', '.'); ?> Bs.</td>
                    </tr>
                </table>

                <p class="subtitulo-resultado">Deducciones aplicadas</p>
                <p class="nota">Escala salarial aplicada: <strong><?php echo $tramo; ?></strong></p>
                <table>
                    <tr>
                        <th>Concepto</th>
                        <th>Porcentaje</th>
                        <th>Monto a descontar</th>
                    </tr>
                    <tr>
                        <td>Ahorro habitacional</td>
                        <td><?php echo number_format($porcentaje_ahorro, 2, ',', '.'); ?> %</td>
                        <td><?php echo number_format($ahorro_habitacional, 2, ',', '.'); ?> Bs.</td>
                    </tr>
                    <tr>
                        <td>Seguro social</td>
                        <td><?php echo number_format($porcentaje_seguro, 2, ',', '.'); ?> %</td>
                        <td><?php echo number_format($seguro_social, 2, ',', '.'); ?> Bs.</td>
                    </tr>
                    <tr class="fila-total">
                        <td colspan="2">Total de deducciones</td>
                        <td><?php echo number_format($total_deducciones, 2, ',', '.'); ?> Bs.</td>
                    </tr>
                </table>

                <p class="neto">Sueldo quincenal neto: <?php echo number_format($sueldo_neto, 2, ',', '.'); ?> Bs.</p>
            </div>
        <?php
        }
        ?>
    </div>
</body>
</html>