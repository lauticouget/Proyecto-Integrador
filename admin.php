<?php
include('functions.php');
include('head.php');
include_once('navBar.php');
if(!adminController())
    {
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

    <body class="container-fluid">
        <div class="container">
            <?php 
            foreach(decodeUsers() as $user)
                {
                ?>
                <form action="eraseUser.php" method="post">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <h1 href="#" class="btn btn-primary"><?php echo $user['username'];?></h1>
                                <input type="hidden" name="eraseUser" value="<?php echo $user['username'] ?> ">
                                <input  type="submit" value="Eliminar"  class="float-right btn btn-danger"> 
                            </div>
                        </li>
                    </ul>
                </form>
                <?php 
                }
            ?>
                    
        </div>
    </body>


</html>