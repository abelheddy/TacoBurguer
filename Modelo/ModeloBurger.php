<?php

function Alta($tabla, $datos)
{
    include 'Conexion.php';
    $sql = "INSERT INTO " . $tabla . " VALUES ($datos);";
    $result = mysqli_query($conexion, $sql);

    if (!$result) {
        $response = array(
            'status' => 'error',
            'message' => 'Uppss ah ocurrido un error'
        );
    } else {

        $response = array(
            'status' => 'success',
            'message' => 'Registro insertado correctamente'
        );
        return json_encode($response);
    }
}

function Eliminar($tabla, $condicion)
{
    include 'Conexion.php';
    $sql = "DELETE FROM " . $tabla . " WHERE " . $condicion . " ;";
    $result = mysqli_query($conexion, $sql);

    if (!$result) {
        $response = array(
            'status' => 'error',
            'message' => 'Uppss ah ocurrido un error'
        );
    } else {
        $response = array(
            'status' => 'success',
            'message' => 'Registro eliminado correctamente'
        );
    }
    return json_encode($response);
}

function Consultar($tabla, $condicion)
{
    include 'Conexion.php';
    $sql = "SELECT * FROM " . $tabla . " " . $condicion . ";";
    $result = mysqli_query($conexion, $sql);

    if (!$result) {

        $response = array(
            'status' => 'error',
            'message' => 'Uppss ah ocurrido un error'
        );
    } else {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 'success',
            'data' => $data
        );
    }
    return json_encode($response);
}

function Actualizar($tabla, $campos, $condicion)
{
    include 'Conexion.php';
    $sql = "UPDATE $tabla SET $campos WHERE $condicion";
    $result = mysqli_query($conexion, $sql);
    if (!$result) {
        $response = array(
            'status' => 'error',
            'message' => 'Uppss ah ocurrido un error'
        );
    } else {
        $response = array(
            'status' => 'success',
            'message' => 'Registro actualizado correctamente'
        );
    }
    return json_encode($response);
}


function actualizarRegistro($tabla, $campos, $condicion)
{
    include 'Conexion.php';
    $sql = "UPDATE $tabla SET $campos WHERE $condicion";
    $result = mysqli_query($conexion, $sql);
    if (!$result) {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error al actualizar el registro'
        );
    } else {
        $response = array(
            'status' => 'success',
            'message' => 'Registro actualizado correctamente'
        );
    }
    return json_encode($response);
}
