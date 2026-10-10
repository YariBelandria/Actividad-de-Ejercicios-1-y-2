# Mis Ejercicios de PHP

Aplicación web SUV con dos ejercicios resueltos en PHP para la asignatura de
Programación Estructurada / Aplicaciones Web.

## Requisitos

- PHP 8 o superior (se recomienda XAMPP).
- Un navegador web.

## Puesta en marcha

1. Copia la carpeta del proyecto dentro de `htdocs` de XAMPP.
   En Linux: `/opt/lampp/htdocs/miproyecto-tarea`
   En Windows: `C:\xampp\htdocs\miproyecto-tarea`
2. Inicia Apache desde el panel de control de XAMPP o con `sudo /opt/lampp/lampp start`.
3. Abre en el navegador: <http://localhost/miproyecto-tarea/>

Si no usas XAMPP, puedes levantar un servidor propio desde la carpeta del proyecto:

```bash
php -S localhost:8000
```

y abrir <http://localhost:8000>.

## Archivos del proyecto

| Archivo | Contenido |
| --- | --- |
| `index.php` | Portada con el menú y los enlaces a los dos ejercicios. |
| `ejercicio1_salario.php` | Ejercicio 1: cálculo de salario quincenal con deducciones variables. |
| `ejercicio2_factura.php` | Ejercicio 2: facturación con IVA y descuento condicional. |

## Ejercicio 1 — Cálculo de Salario Quincenal con Deducciones Variables

### Qué hace

Recibe por formulario HTML el nombre, la cédula y las horas trabajadas en los tres
turnos del quincenio. Con las tarifas fijas calcula el sueldo bruto, determina en qué
escala salarial se ubica el sueldo y aplica las deducciones correspondientes de
Ahorro Habitacional y Seguro Social. Finalmente muestra el sueldo quincenal neto.

### Tarifas por hora

| Turno | Tarifa |
| --- | --- |
| Diurno | 675 Bs. |
| Vespertino | 700 Bs. |
| Nocturno | 956.23 Bs. |

### Fórmulas

```
sueldo_diurno     = horas_diurna     * 675
sueldo_vespertino = horas_vespertina * 700
sueldo_nocturno   = horas_nocturna   * 956.23

sueldo_bruto = sueldo_diurno + sueldo_vespertino + sueldo_nocturno
```

Las deducciones dependen del monto del sueldo bruto:

| Sueldo bruto | Ahorro Habitacional | Seguro Social |
| --- | --- | --- |
| Menor a 85.000 Bs. | 10 % | 15 % |
| Entre 85.000 Bs. y 150.000 Bs. | 15 % | 20 % |
| Mayor a 150.000 Bs. | 30 % | 25 % |

```
ahorro_habitacional = sueldo_bruto * 0.10   (decimal según la escala)
seguro_social       = sueldo_bruto * 0.15

total_deducciones = ahorro_habitacional + seguro_social
sueldo_neto       = sueldo_bruto - total_deducciones
```

### Salida en pantalla

Datos personales del trabajador, sueldo por cada turno, sueldo quincenal bruto, los
porcentajes y montos de cada deducción, el total de deducciones y el sueldo quincenal neto.

## Ejercicio 2 — Facturación con IVA, Descuento Condicional y Unidades Múltiples

### Qué hace

Recibe por formulario HTML la descripción del artículo, la cantidad adquirida y el
precio unitario de venta. Calcula el subtotal, aplica el IVA, y si el total con IVA
supera los 150 $ descuenta un 15 % adicional. Muestra el desglose completo de la factura.

### Fórmulas

```
subtotal      = cantidad * precio_unitario
valor_iva     = subtotal * (12 / 100)
total_con_iva = subtotal + valor_iva
```

Si `total_con_iva > 150` entonces:

```
monto_descuento = total_con_iva * (15 / 100)
total_neto      = total_con_iva - monto_descuento
```

Si no supera el monto, el descuento es 0 y el total neto es el mismo total con IVA.

### Salida en pantalla

Detalle de la venta, subtotal, valor del IVA, total con IVA, indicación de si el
descuento aplica o no con su monto, y el monto total neto a pagar.

## Autor

Yacrianny Belandria
