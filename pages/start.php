<?php
    require_once("../util/connection.php");
    if(isset($_SESSION["email"])){
        if($_SESSION["email"] == "admin"){
            header("Location: ../pages/adminStart.php");
        }
        else{
            header("Location: ../pages/userStart.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCC</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../tailwind/tailwind.css">
</head>
<body>
    <div class="w-full h-screen bg-tcc-darkBlue">
        <?php require("../components/navbar.php")?>
        <?php require("../components/jumbotron.php")?>
    </div>
</body>
</html>