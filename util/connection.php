<?php
    session_start();

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tccpenyisihan";
    $conn = new mysqli($host, $username, $password, $dbname);
    
    if($conn->connect_errno){
        die("Connection Failed : ".$conn-> connect_error);
    }
?>