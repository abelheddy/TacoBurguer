<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Estilos_tablas.css" type="text/css">
    <title>Document</title>
</head>

<body>

    <?php
    // Conexión a la base de datos
    include('../Modelo/Conexion.php');
    include('../Modelo/ModeloBurger.php');
    // Verificar si se ha enviado el formulario


    if (isset($_POST['enVenta'])) {
        // Obtener la fecha y hora actual
        $fecha = date("Y-m-d");
        // Inicializar el monto total de la venta
        $monto_total = 0;
        $cambio = $_POST['cambio'];

        // Recorrer los datos del formulario
        foreach ($_POST['cantidad'] as $id_platillo => $cantidad) {
            // Obtener el nombre y el costo del platillo
            $resultado = mysqli_query($conexion, "SELECT MAX(id_auxventa) AS ultimo_id FROM auxventa");
            $idaux = mysqli_fetch_assoc($resultado)['ultimo_id'];
            $resultado = json_decode(Consultar('platillo', 'WHERE id_platillo =' . $id_platillo), true);
            $fila = $resultado['data'];
            $id = $id_platillo;
            $nombre_platillo = $fila[0]['platillo'];
            $costo_platillo = $fila[0]['costo'];


            // Calcular el subtotal del platillo
            $subtotal_platillo = floatval($costo_platillo) * floatval($cantidad);

            // Agregar el platillo vendido al array de productos vendidos
            $productos_vendidos[] = array(
                'id' => $id_platillo,
                'platillo' => $nombre_platillo,
                'cantidad' => $cantidad,
                'precio' => $costo_platillo,
                'subtotal' => $subtotal_platillo
            );
            if ($cantidad > 0) {
                $idaux += 1;
                $datos = "" . intval($idaux) . "," . intval($id) . "," . intval($cantidad) . "";
                Alta('auxventa', $datos);
                // Actualizar el monto total de la venta
                $monto_total += floatval($subtotal_platillo);
            }

            if ($cambio > $subtotal_platillo) {
                $cambio_total = intval($cambio) - intval($monto_total);
            } else {
                echo '<script type="text/javascript">';
                echo 'alert("Creo que te haz confundido la cantidad que recibiste no alcanza para pagar el servicio");';
                echo '</script>';
                header('Location:' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        }

        // Registrar la venta en la tabla de ventas
        $datos = "null,'" . $fecha . "'," . $idaux . "," . $monto_total . ",11";
        $resultado = json_decode(Alta('venta', $datos), true);
        if ($resultado['status'] == 'success') {
            echo '<script type="text/javascript">';
            echo 'alert("SE REGISTRO LA VENTA CORRECTAMENTE");';
            echo '</script>';
        }
    }

    if (isset($_POST['Cancelar'])) {
        header('Location:../Vistas/Ventas.php');
    }
    // Mostrar la información de la venta y los productos vendidos
    echo "<div class='ticket-venta'>";
    echo "<h2>Información de la venta:</h2>";
    echo "<p><strong>Fecha de venta:</strong> " . $fecha . "</p>";
    echo "<p><strong>Monto total:</strong> $" . $monto_total . "</p>";
    echo "<p><strong>Se recibio:</strong> $" . $cambio . "</p>";
    echo "<p><strong>Cambio:</strong> $" . $cambio_total . "</p>";
    echo "<h2>Productos vendidos:</h2>";
    echo "<table>";
    echo "<tr><th>Platillo</th><th>Cantidad</th><th>Precio unitario</th><th>Subtotal</th></tr>";
    foreach ($productos_vendidos as $producto) {
        if ($producto['cantidad'] > 0) {
            echo "<tr>";
            echo "<td>" . $producto['platillo'] . "</td>";
            echo "<td>" . $producto['cantidad'] . "</td>";
            echo "<td>$" . $producto['precio'] . "</td>";
            echo "<td>$" . $producto['subtotal'] . "</td>";
            echo "</tr>";
        }
    }
    echo "<tr>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td>Monto total:</td>";
    echo "<td>$" . $monto_total . "</td>";
    echo "</tr>";
    echo "</table>";
    echo "<button class='boton-volver'><a href='../Vistas/Ventas.php'>Volver a ventas</a></button>";
    echo "</div>";
    ?>
</body>

</html>