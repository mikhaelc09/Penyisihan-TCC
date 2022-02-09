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
    else if($requestType == "getQuestion"){
        if($_COOKIE["counter"] < count(json_decode($_COOKIE["sequence"]))){
            $problemNumber = json_decode($_COOKIE["sequence"])[$_COOKIE["counter"]];
            $stmt = $conn->query("SELECT soal_id, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, pilihan_e, durasi, gambar_soal FROM soal WHERE soal_id=$problemNumber");
            $s = $stmt->fetch_assoc();
            $s["counter"] = $_COOKIE["counter"];
            echo json_encode($s);
            setcookie("counter", $_COOKIE["counter"]+1, $_COOKIE["endTime"], '/');
        }
        else{
            echo "Finish";
        }
    }
    else if($requestType == "checkAnswer"){
        $stmt = $conn->query("SELECT jawaban_benar FROM soal WHERE soal_id=$soal_id");
        $soal = $stmt->fetch_assoc();
        $score = ($soal["jawaban_benar"] == $choice)?1:0;
        echo $score;
        $emailUser = $_SESSION["email"];
        $stmt = $conn->query("SELECT score FROM peserta WHERE email='$emailUser'");
        $pst = $stmt->fetch_assoc();
        $scoreBaru = $pst["score"] +$score;
        $stmt = $conn->prepare("UPDATE peserta SET score=$scoreBaru WHERE email='$emailUser'");
        $stmt->execute();
    }
    else if($requestType == "getFinalScore"){
        $emailUser = $_SESSION["email"];
        $stmt = $conn->query("SELECT user_id, score FROM peserta WHERE email='$emailUser'");
        $peserta = $stmt->fetch_assoc();
        $quiz_id = $_COOKIE["quizid"]??$_SESSION["quizid"];
        $stmt = $conn->query("SELECT COUNT(*) as jumlah FROM soal WHERE quiz_id=$quiz_id");
        $soal = $stmt->fetch_assoc();
        $finalScore = ROUND($peserta["score"]/$soal["jumlah"]*100);
        echo $finalScore;
        $stmt = $conn->prepare("INSERT INTO quiz_summary(user_id, score) VALUES(?,?)");
        $stmt->bind_param("ii",$peserta["user_id"], $peserta["score"]);
        $stmt->execute();
        setcookie("quizid","", time() - 10000, '/');
        setcookie("sequence","", time()  - 10000, '/');
        setcookie("counter", "", time() - 10000, '/');
        setcookie("startTime", "" , time() - 10000, '/');
        setcookie("endTime", "" , time() - 10000, '/');
        if(isset($_SESSION["quizid"]))
            unset($_SESSION["quizid"]);
    }
?>