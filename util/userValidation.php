<?php
    if(!isset($_SESSION["email"])){
        header("Location: ../pages/login.php");
    }
?>