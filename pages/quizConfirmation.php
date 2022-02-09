<?php
    require_once("../util/connection.php");
    require_once("../util/userValidation.php");
    require_once("../util/DateTimeCalculator.php");
    require_once("../util/inQuizChecker.php");

    if(isset($_GET["id"])){
        $quiz_id = $_GET["id"];
        $stmt = $conn->query("SELECT quiz.*, ctr.c as problems, ctr.totalduration FROM quiz, (SELECT COUNT(*) as c, SUM(durasi) AS totalduration FROM soal WHERE quiz_id=$quiz_id) as ctr WHERE quiz_id=$quiz_id");
        $quiz = $stmt->fetch_assoc();
        if(!isset($quiz)){
            header("Location: ../pages/notFound.php");
        }
    }
    else{
        header("Location: ../pages/notFound.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Confirmation | TCC</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../tailwind/tailwind.css">
</head>
<body>
    <div class="w-full h-screen bg-tcc-darkBlue flex items-center justify-center">
        <div class="w-4/5 h-4/5 bg-tcc-darkGray flex flex-col items-center justify-center gap-3">
            <h1 class="text-6xl font-bold text-gray-100 pb-2"><?=$quiz["quiz_name"]?></h1>
            <div class="flex w-3/5 justify-center items-center gap-5 text-gray-100 my-5">
                <div class="flex flex-col justify-center items-center font-bold text-2xl ">
                    <span><?=getDateFormatted($quiz["time_start"],'l, d F Y')?></span>
                    <span><?=getTimeFormatted($quiz["time_start"],'h:i A T (P)')?></span>
                </div>
                <span class="text-3xl">-</span>
                <div class="flex flex-col justify-center items-center font-bold text-2xl ">
                    <span><?=getDateFormatted($quiz["time_end"],'l, d F Y')?></span>
                    <span><?=getTimeFormatted($quiz["time_end"],'h:i A T (P)')?></span>
                </div>
            </div>
            <?php
                $active = false;
                if($quiz["status"] == 0){
                    echo "<h5 class='text-orange-500 font-bold'>Quiz unavailable</h5>";
                }
                else{
                    $ddstart = getCurrentDateDifference($quiz["time_start"]);
                    $ddend = getCurrentDateDifference($quiz["time_end"]);
                    if(getSecondsInterval($ddstart) > 0){
                        if(getSecondsInterval($ddend) > 0){
                            echo "<h5 class='text-orange-500 font-bold'>The quiz has ended already</h5>";
                        }
                        else{
                            $active = true;
                        }
                    }
                    else{
                        echo "<h5 class='text-orange-500 font-bold'>The quiz hasn't started</h5>";
                    }
                }
            ?>
            <h1 class="text-xl font-bold text-gray-100">Total Problems : <?=$quiz["problems"]?></h1>
            <h1 class="text-xl font-bold text-gray-100 pb-10">Duration : <?=(FLOOR($quiz["totalduration"]/3600)>0)?FLOOR($quiz["totalduration"]/3600)." hr":""?> <?=(FLOOR($quiz["totalduration"]%3600/60)>0)?FLOOR($quiz["totalduration"]%3600/60)." min":""?> <?=(FLOOR($quiz["totalduration"]%60)>0)?FLOOR($quiz["totalduration"]%60)." sec":""?></h1>
            <a href="../pages/quiz.php?id=<?=$quiz_id?>"><button class="bg-blue-600 text-gray-200 font-bold px-5 py-2 text-xl rounded-lg disabled:bg-blue-400" <?=($active)?"":"disabled"?>>Take Quiz</button></a>
            <a href="../pages/start.php"><button class="bg-gray-200 text-blue-600 font-bold px-5 py-1 text-sm rounded-lg">Go Back</button></a>
        </div>
    </div>
</body>
</html>

