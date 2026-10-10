<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salario Quincenal</title>
</head>
<body>

    <h1>Ejercicio 1</h1>
    <p>Cálculo del sueldo quincenal de un trabajador según las horas trabajadas
    en tres turnos: diurno (675 Bs.), vespertino (700 Bs.) y nocturno (956.23 Bs.).</p>
    <hr>

    <form method="post" action="">
        Nombre: <input type="text" name="nombre"><br><br>
        Cédula: <input type="text" name="cedula"><br><br>
        Horas diurnas: <input type="number" name="horas_diurna"><br><br>
        Horas vespertinas: <input type="number" name="horas_vespertina"><br><br>
        Horas nocturnas: <input type="number" name="horas_nocturna"><br><br>
        <input type="submit" name="calcular" value="Calcular sueldo">
    </form>

    <?php
    if (isset($_POST["calcular"])) {

        $nombre = $_POST["nombre"];
        $cedula = $_POST["cedula"];
        $horas_diurna = $_POST["horas_diurna"];
        $horas_vespertina = $_POST["horas_vespertina"];
        $horas_nocturna = $_POST["horas_nocturna"];

        $sueldo_diurno = $horas_diurna * 675;
        $sueldo_vespertino = $horas_vespertina * 700;
        $sueldo_nocturno = $horas_nocturna * 956.23;

        $sueldo_bruto = $sueldo_diurno + $sueldo_vespertino + $sueldo_nocturno;

        if ($sueldo_bruto < 85000) {
            $porc_ahorro = 0.10;
            $porc_seguro = 0.15;
        } elseif ($sueldo_bruto <= 150000) {
            $porc_ahorro = 0.15;
            $porc_seguro = 0.20;
        } else {
            $porc_ahorro = 0.30;
            $porc_seguro = 0.25;
        }

        $ahorro = $sueldo_bruto * $porc_ahorro;
        $seguro = $sueldo_bruto * $porc_seguro;
        $deducciones = $ahorro + $seguro;
        $sueldo_neto = $sueldo_bruto - $deducciones;

        echo "<hr>";
        echo "<h3>Datos del trabajador</h3>";
        echo "Nombre: $nombre <br>";
        echo "Cédula: $cedula <br>";

        echo "<h3>Sueldo por turno</h3>";
        echo "Diurno: " . round($sueldo_diurno, 2) . " Bs. <br>";
        echo "Vespertino: " . round($sueldo_vespertino, 2) . " Bs. <br>";
        echo "Nocturno: " . round($sueldo_nocturno, 2) . " Bs. <br>";
        echo "Sueldo bruto: " . round($sueldo_bruto, 2) . " Bs. <br>";

        echo "<h3>Deducciones</h3>";
        echo "Ahorro habitacional (" . ($porc_ahorro * 100) . "%): " . round($ahorro, 2) . " Bs. <br>";
        echo "Seguro social (" . ($porc_seguro * 100) . "%): " . round($seguro, 2) . " Bs. <br>";
        echo "Total deducciones: " . round($deducciones, 2) . " Bs. <br>";

        echo "<h2>Sueldo quincenal neto: " . round($sueldo_neto, 2) . " Bs.</h2>";
    }
    ?>

</body>
</html>