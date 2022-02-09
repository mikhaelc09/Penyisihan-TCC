<?php
    if(isset($_COOKIE["quizid"])){
        header("Location: ../pages/quiz.php?id=".$_COOKIE["quizid"]);
    }
?>