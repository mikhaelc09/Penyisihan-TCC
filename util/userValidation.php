<?php
    if(!isset($_SESSION["email"])){
        header("Location: ../pages/login.php");
    }
    else{
        $emailUser = $_SESSION["email"];
        $stmt = $conn->query("SELECT * FROM peserta WHERE email='$emailUser'");
        $user = $stmt->fetch_assoc();
    }
?>