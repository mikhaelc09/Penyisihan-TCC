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
                    echo "<a href='../pages/quizDetail.php?quiz_id=".$qz["quiz_id"]."'><button class='w-24 py-1 bg-blue-500 h-10 hover:bg-blue-400'>Detail</button></a>";
                    echo "<button class='w-24 py-1 bg-tcc-emerald h-10 hover:bg-emerald-300' onclick='editQuiz(".$qz["quiz_id"].")'>Edit</button>";
                    echo "<button class='w-24 py-1 bg-red-500 h-10 hover:bg-red-400' onclick='deleteQuiz(".$qz["quiz_id"].")'>Delete</button>";
                echo "</div>";
            echo "</div>";
        }
    }
    else if($requestType == "deleteQuiz"){
        $result = $conn->query("DELETE FROM quiz WHERE quiz_id=$quizId");
    }
    else if($requestType == "editQuiz"){
        $stmt = $conn->prepare("UPDATE quiz SET quiz_name=?, time_start=?, time_end=? WHERE quiz_id=$quizId");
        $stmt->bind_param("sss",$quizName, $quizStartTime, $quizEndTime);
        if($stmt->execute()){
            echo "Berhasil update quiz!";
        }
    }
    else if($requestType == "getAllData"){
        $stmt = $conn->query("SELECT quiz_id, quiz_name, DATE_FORMAT(time_start, '%Y-%m-%dT%H:%i') as time_start, DATE_FORMAT(time_end, '%Y-%m-%dT%H:%i') as time_end , status FROM quiz WHERE quiz_id=$quizId");
        $quiz = $stmt->fetch_assoc();
        echo json_encode($quiz);
    }
    else if($requestType == "toggleStatus"){
        echo $status;
        $stmt = $conn->prepare("UPDATE quiz SET status=? WHERE quiz_id=?");
        $stmt->bind_param("ii",$status, $quiz_id);
        if($stmt->execute()){
            echo "Berhasil Toggle Status";
        }
    }
?>