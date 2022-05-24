<?php
//*************INICIO DE SESION****************************************************************************
session_start();
$_SESSION['fecha']=date('YmdHis');
if(isset($_POST['login'])){
require "acnxerdm/cnx.php";
    $usuario=$_POST['usuario'];
    $password=$_POST['pass'];
    $login = "SELECT * FROM usuarionuevo 
        inner join usuario on usuarionuevo.id_usuarioNuevo=usuario.id_usuarioNuevo
        WHERE usuarionuevo.usuario = '$usuario' and usuario.clave='$password'";
        $datos=sqlsrv_query($cnx,$login);
        $log=sqlsrv_fetch_array($datos);
			if($log){
                if($log['estado']=='1'){
                    $_SESSION['tipousuario']='1';
                }
                
                $_SESSION['user']=$log['id_usuarioNuevo'];
                $fecha=date('Y/m/d_H:i:s');
                $id_usuarioNuevo=$log['id_usuarioNuevo'];
                $idusr=$log['id_usuario'];
                $fecha=date('Y-m-d');
                $hora=date('H:i:s');
                $dia=date('w');
                
                $login="UPDATE usuario SET acceso='$fecha' WHERE id_usuarioNuevo='$id_usuarioNuevo'";
                sqlsrv_query($cnx,$login);  // actualizar access
                
                $accesos="insert into accesos (id_usuario,fecha,hora,dia) values ('$idusr','$fecha','$hora',$dia)";
                sqlsrv_query($cnx,$accesos) or die ('No se ejecuto la consulta isert reg accesos'); //Insert accesos
                
                echo '<meta http-equiv="refresh" content="0,url=kpiestrategas/php/acceso.php">';
			} else{
				echo "<script>
                alert('Su usuario o contraseña no son válidos, inténtelo nuevamente o contacte al administrador.');
                </script>";
			}
    }
//***********************FIN INICIO DE SESION**************************************************************
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KPIs | Estrategas</title>
<link rel="icon" href="kpiestrategas/icono/icon.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" type="text/css" href="kpiestrategas/css/bootstrap.css">
 <link href="kpiestrategas/fontawesome/css/all.css" rel="stylesheet">
<style> 
  body {
        background-image: url(kpiestrategas/img/back.jpg);
        background-repeat: no-repeat;
        background-size: 100%;
        background-attachment: fixed;
    }
        body{
    font-family: sans-serif;
    font-style: normal;
    font-weight:bold;
    width: 100%;
    height: 100%;
}
    </style>
</head>
<body>
    <br><br><br>
<!--*********************TARGETA INICIO DE SESION*****************************************************-->
<form class="form-inline" method="post">
<div class="card" style="width:22rem;margin:auto;box-shadow: 1px 1px 5px #717171;">
 <a href="">
     <img src="kpiestrategas/img/login.png" class="card-img-top" alt="..."></a>
  <div class="card-body">
 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
  </div>
  <input type="text" name="usuario" class="form-control border border-secondary" placeholder="Nombre de Usuario" aria-label="Username" aria-describedby="basic-addon1" required autofocus>
</div>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock-open"></i></span>
  </div>
  <input type="password" name="pass" class="form-control border border-secondary" placeholder="Contraseña" aria-label="Username" aria-describedby="basic-addon1" required>
</div>
      <button  type="submit" name="login" class="btn btn-primary" id="botones" data-toggle="tooltip" data-placement="bottom" title="Iniciar Sesion">Iniciar Sesion</button><br>
<!--
       <span style="font-size:14px"><a href="registro.php">Registrarte</a></span><br>
       <span style="font-size:14px"><a href="#" data-toggle="modal" data-target="#lostpass">¿Olvidaste tu contraseña?</a></span>
-->
  </div>
</div>
    </form>
<!--***********************************************FIN TARGETA INICIO DE SESION*****************************************************--> 
    </body>
<br>    
    <footer class="text-center">
      <div class="container">
         <span class="navbar-text" style="font-size:11px;font-weigth:bold;">Sistema de KPIs Estrategas de Mexico<br>
             Centro de Inteligencia Informática y Geografía Aplicada<br>
             Creado y diseñado por © 2021 Estrategas de México
          </span> 
      </div>
    </footer>
<script src="kpiestrategas/js/jquery-3.4.1.min.js"></script>
<script src="kpiestrategas/js/bootstrap.js"></script>
</html>