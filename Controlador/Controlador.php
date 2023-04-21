<?php 
   include '../Modelo/ModeloBurger.php';

    
    if(isset($_POST['EnviarUs'])){
        $Nom = $_REQUEST['nom'];
        $psw = $_REQUEST['psw'];
        $nivel = $_REQUEST['nvl'];
        $datos = "null,'".$Nom."','".$psw."','".$nivel."'";
        $alta = json_decode(Alta('usuario',$datos),true);
        
        header("Location: ../Vistas/Agregar_Usuario.php");
        exit;
    }

    if(isset($_POST['RegistIng'])){
        $Ingre = $_REQUEST['ingrediente'];
        $datos = "null,'".$Ingre."'";
        $res = json_decode(Alta('ingrediente',$datos),true);
        if ($res['status'] == 'success') {
            echo '<script>alert("Alta Realizada correctamente");
            window.location.href = "../Vistas/ConsultaIngredientes.php";
            </script>';
        }
    }

    if(isset($_POST['RegistPlatillo'])){
        $nomPlatillo = $_REQUEST['nomPlatillo'];
        $precio = $_REQUEST['precio'];
        $datos = "null,'".$nomPlatillo."',".$precio."";

        Alta('platillo',$datos);

        header("Location: ../Vistas/Agregar_Platillo.php");

    }
?>