<?php
include('functions.php');
include('head.php');
include_once('navBar.php');

?>
<!DOCTYPE html>
<html lang="en">

    <body class="container-fluid">
        <div class="container">
            <ul class="list-group">
                <?php 
                    foreach(decodeUsers() as $user)
                        {?>
                            <li class="list-group-item">
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <a href="#" class="btn btn-primary"><?php echo $user['username'];?></a>
                                </div>
                            </li>

                        <?php 
                        }
                ?>
            </ul>
        </div>
    </body>


</html>