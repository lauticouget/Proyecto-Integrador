<?php 
include_once('functions.php');



if($_POST)
    {
        eraseUser($_POST['eraseUser']);   
        header('location: admin.php');
    }

?>;