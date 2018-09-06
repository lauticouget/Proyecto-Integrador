<?php 
include_once('functions.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">

    <title>Inicio</title>
</head>
<body class="container-fluid">
    <span class="alert alert-danger"><?php    $session    ?></span>
    
    
    <img class="img-fluid hero-image" src="images/Muestra.logo-puntoVet-original.jpg" alt="logo" class="hero-image">
    <nav id="nav">
        <ul class="navbar navbar-btn text-center">
            <li> <a href="index.php">Inicio</a></li>
            <li> <a href="login.php">Ingreso</a></li>
            <li> <a href="formulario.php">Contáctanos</a></li>
            <li> <a href="faq.php">Preguntas Frecuentes</a></li>
            <li> <a href="register.php">Registrate</a></li>
        </ul>
    </nav>
    <div class="container-fluid text-center"id="hero">
        <img class=" img-fluid" src="images/hero.jpg">
    </div>
    
    
</body>
</html>