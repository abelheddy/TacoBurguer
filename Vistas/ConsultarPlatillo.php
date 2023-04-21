<?php
include('Menu.php');
?>
<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="../css/Estilos_tablas.css" type="text/css">

</head>
<center>

    <body>



        <div class="container">
            <div class="ContBtn2">
                <h1>Tabla Platillos</h1>
            </div>

            <form action="" method="GET">
                <div class="ContTable">
                    <table>

                        <thead>
                            <tr class='row100 head'>
                                <th>
                                    <center>ID</center>
                                </th>
                                <th>
                                    <center>PLATILLO</center>
                                </th>
                                <th>
                                    <center>COSTO</center>
                                </th>
                                <th>
                                    <center>EDITAR</center>
                                </th>
                                <th>
                                    <center>ELIMINAR</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            require('../Modelo/Conexion.php');
                            ?>



                            <?php
                            require("../Modelo/ModeloBurger.php");

                            $result = json_decode(Consultar('platillo', "ORDER BY id_platillo"), true);
                            foreach ($result['data'] as $crow) {
                            ?>
                                <tr class='row100'>
                                    <td style='width:10px'>
                                        <center> <?php echo $crow['id_platillo']; ?> </center>
                                    </td>
                                    <td>
                                        <center><?php echo $crow['platillo']; ?> </center>
                                    </td>
                                    <td>
                                        <center><?php echo $crow['costo']; ?></center>
                                    </td>
                                    <td>
                                        <a class="btnEd" href="../Modelo/Editar_Platillo.php?EDITAR_ID=<?php echo $crow['id_platillo']; ?>">Editar</a>
                                    </td>
                                    <td>
                                        <a class="btnEl" href="../Modelo/Editar_Platillo.php?ELIMINAR_ID=<?php echo $crow['id_platillo']; ?>">Eliminar</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
        </div>
        </form>
    </body>
</center>

</html>