<nav class="mx-auto navbar navbar-expand-lg  navbar-dark bg-dark ">
    <a class="navbar-brand mx-auto " href="index.php" >Inicio</a>
    <a class="navbar-brand mx-auto " href="perfil.php">Mi Perfíl</a>

    

    <a class="navbar-brand mx-auto" href="contacto.php">Contáctanos</a>
    <a class="navbar-brand mx-auto" href="faq.php" >Preguntas Frecuentes</a>

    <div class="navbar-brand mx-auto ">
        <label for="search">Search</label>
        <input type="Search">
        
    </div>

    <?php     
    if(!isset($_SESSION['email']))
    { ?>
        <a class="navbar-brand mx-auto " href="login.php">Ingreso</a>
        <a class="navbar-brand mx-auto " href="register.php">Registrate</a>
    <?php }
    ?>

    <?php if (isset($_SESSION['email']))
    { ?>
    <a class="navbar-brand mx-auto " href="logout.php">Logout</a>
    <?php } ?>

    

</nav>