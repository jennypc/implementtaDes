<?php
require "../../acnxerdm/cnx.php";

    if(isset ($_POST['add'])) {
		$nombre = ($_POST["nombre"]);
		$apellidoP = ($_POST["apellidoP"]);
        $apellidoM = ($_POST["apellidoM"]);
		$email = ($_POST["email"]);
        $contra = ($_POST["contraseña"]);
        
		$sql = "INSERT INTO users VALUES ('$nombre','$apellidoP','$apellidoM','$email','$contra');";
		$sqlResult =sqlsrv_query($cnx,$sql);
        
        if ($sqlResult){
             Header("Location: inicio.php");
            
        }else{
            echo "no funciona ";
            if(!$sqlResult)die(print_r(sqlsrv_errors(), true));
        }
      
	}
?>