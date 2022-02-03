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
    else if($requestType == "listQuiz"){
        $stmt = $conn->prepare("SELECT * FROM quiz");
        $stmt->execute();
        $quizzes= $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        foreach ($quizzes as $key => $qz) {
            echo "<div class='w-4/5 h-24 bg-tcc-darkGray mx-auto my-3 px-4 py-2'>";
                echo "<span class='text-xl font-bold'>".$qz["quiz_name"]."</span>";
                echo "<div class='flex justify-between pt-3'>";
                    echo "<button class='px-10 py-1 bg-tcc-emerald'>Edit</button>";
                    echo "<button class='px-10 py-1 bg-tcc-emerald'>Delete</button>";
                echo "</div>";
            echo "</div>";
        }
    }
?>