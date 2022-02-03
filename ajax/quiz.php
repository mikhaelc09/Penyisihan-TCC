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
            echo "<div class='w-4/5 h-24 bg-tcc-darkGray mx-auto my-3 px-4 py-2 flex flex-row justify-between'>";
                echo "<span class='text-2xl font-bold text-blue-50'>".$qz["quiz_name"]."</span>";
                echo "<div class='flex justify-end pt-3 gap-x-2 items-end pb-2'>";
                    echo "<button class='w-24 py-1 bg-tcc-emerald h-10 hover:bg-emerald-300'>Edit</button>";
                    echo "<button class='w-24 py-1 bg-red-500 h-10 hover:bg-red-400'>Delete</button>";
                echo "</div>";
            echo "</div>";
        }
    }
?>