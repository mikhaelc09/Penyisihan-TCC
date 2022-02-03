<?php
    require_once("../util/connection.php");

    foreach ($_POST as $key => $value) {
        $$key = $value;
    }

    if($requestType == "createQuiz"){
        $stmt = $conn->prepare("INSERT INTO quiz(quiz_name, time_start, time_end, status) VALUES(?,?,?,0)");
        $stmt->bind_param("sss",$quizName, $quizStartTime, $quizEndTime);
        if($stmt->execute()){
            echo  "Quiz Created";
        }
        else{
            echo  "Failed to create Quiz";
        }
    }
?>