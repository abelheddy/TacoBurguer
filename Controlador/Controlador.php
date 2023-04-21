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
?>