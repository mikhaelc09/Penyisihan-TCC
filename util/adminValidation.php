<?php
    if(isset($_SESSION['email'])){
        if($_SESSION['email'] != 'admin'){
            header("Location: ../pages/login.php");
        }
    }
    else{
        header("Location: ../pages/login.php");
    }
?>