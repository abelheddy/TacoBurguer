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
                <h1>Tabla Ingredientes</h1>
            </div>
            <div class="ContTable">
                <table>
                    <thead>
                        <tr class='row100 head'>
                            <th>
                                <center>ID</center>
                            </th>
                            <th>
                                <center>IGREDIENTE</center>
                            </th>
                            <th>
                                <center>EDITAR</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        require('../Modelo/Conexion.php');
                        ?>



                        <?php
                        require("../Modelo/ModeloBurger.php");

                        $result = json_decode(Consultar('ingrediente', "ORDER BY id_ingrediente"), true);
                        foreach ($result['data'] as $crow) {
                        ?>
                            <tr class='row100'>
                                <td style='width:10px'>
                                    <center> <?php echo $crow['id_ingrediente']; ?> </center>
                                </td>
                                <td>
                                    <center><?php echo $crow['ingrediente']; ?> </center>
                                </td>

                                <td>
									<a class="btnEd" href="../Modelo/Editar_Ingrediente.php?EDITAR_ID=<?php echo $crow['id_ingrediente']; ?>">Editar</a>
								</td>
								<td>
									<a class="btnEl" href="../Modelo/Editar_Ingrediente.php?ELIMINAR_ID=<?php echo $crow['id_ingrediente']; ?>">Eliminar</a>
								</td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </body>
</center>

</html>