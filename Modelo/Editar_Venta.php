<?php
require("../Modelo/ModeloBurger.php");
require("../Vistas/Menu.php");

error_reporting(E_ERROR | E_PARSE);

// Si se recibió un ID de usuario a editar
if (!empty($_GET['EDITAR_ID'])) {
    $id = $_GET['EDITAR_ID'];
    $result = json_decode(Consultar('venta', 'WHERE id_venta =' . $id . ''), true);

    // Si se encontró el usuario, mostrar el formulario para editarlo
    if (!empty($result['data'][0])) {
        $row = $result['data'][0];
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link rel="stylesheet" href="../css/Estilos_Inputs.css" type="text/css">
            <title>EDITAR CLIENTES</title>
            <!--======================================= ESTILO DE LA TABLA PLOMO ==============================-->
            <script language="javascript" type="text/javascript">
                function windowClose() {
                    window.open('', '_parent', '');
                    window.close();
                }
            </script>
        </head>

        <body>
            <div class="container">
                <form method="post" action="">
                    <label>Fecha</label>
                    <div class="form-group">
                        <input id="fecha" name="fecha" class="element text medium" type="text" maxlength="255" value="<?php echo $row['fecha']; ?>" />
                    </div>
                    <label>Monto Total: </label>
                    <div class="form-group">
                        <input id="monto" name="monto" type="text" value="<?php echo $row['monto_total']; ?>" />
                    </div>
                    <div class="form-group">
                        <button id="saveForm" type="submit" name="enviar">EDITAR</button>
                        <button class="button2" type="submit" onclick="javascript: form.action='../Vistas/ConsultaUsuarios.php';">REGRESAR</button>
                    </div>
                </form>
            </div>
            <?php
            // Si se recibió un envío del formulario
            if (isset($_POST["enviar"])) {

                $fecha = $_POST["fecha"];
                $monto = $_POST["monto"];

                $res = json_decode(Actualizar("venta", "fecha =TRIM('" . $fecha . "'), monto_total=TRIM(" . $monto . ")", "id_venta = " . $id . ""), true);
                if ($res['status'] == 'success') {
                    echo '<script>alert("Registro Actualizado");
					window.location.href = "../Vistas/ConsultarVenta.php";
					</script>';
                }
            }
            ?>
        </body>

        </html>
    <?php
    } else {
        // Si el usuario no fue encontrado, mostrar un mensaje de error
        echo "<p>El usuario con ID $id no existe.</p>";
    }
}

if (!empty($_GET['ELIMINAR_ID'])) {
    $id = $_GET['ELIMINAR_ID'];
    $result = json_decode(Consultar('usuario', 'WHERE id_Usuario =' . $id . ''), true);

    // Si se encontró el usuario, mostrar el formulario para editarlo
    if (!empty($result['data'][0])) {
        $row = $result['data'][0];
    ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link rel="stylesheet" href="../css/Estilos_Inputs.css" type="text/css">
        </head>

        <body>
            <div class="container">
                <form method="post" action="">
                    <center><label>Estas seguro que quieres eliminar el regitro:</label>
                        <br><Label><?php echo $row['id_Usuario'] . " " . $row['nombre'] . " " . $row['password'] . " " . $row['nivel']; ?></Label>
                    </center>

                    <div class="form-group">
                        <button type="submit" name="SI">SI</button>
                        <button class="button2" type="submit" onclick="javascript: form.action='../Vistas/ConsultarVenta.php';">NO</button>
                    </div>
                </form>
            </div>
        </body>

        </html>
<?php
    } else {
        // Si el usuario no fue encontrado, mostrar un mensaje de error
        echo "<p>El usuario con ID $id no existe.</p>";
    }

    if (isset($_POST['SI'])) {
        $res = json_decode(Eliminar("usuario", "id_Usuario = " . $id . ""), true);
        header("Location: ../Vistas/ConsultaUsuarios.php");
        exit;
    }
}
