<?php
include('Menu.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Estilos_Inputs.css" type="text/css">
    <title>Agregar Ingredientes</title>
</head>

<body>
    <div class="container">
        <form action="../Controlador/Controlador.php" method="POST">

            <h1>Alta De Ingredientes</h1>
            <label>Ingrediente:</label>
            <div class="form-group">
                <input type="text" name="ingrediente">
            </div>
            <div class="form-group">
                <button type="submit" name="RegistIng">Registrar</button>
            </div>
        </form>
    </div>
</body>

</html>