<?php
    require_once("../util/connection.php");
    require_once("../util/userValidation.php");

    if(isset($_GET["id"])){
        $quiz_id = $_GET["id"];
        $stmt = $conn->query("SELECT quiz.*, ctr.c as problems FROM quiz, (SELECT COUNT(*) as c FROM soal WHERE quiz_id=$quiz_id) as ctr WHERE quiz_id=$quiz_id");
        $quiz = $stmt->fetch_assoc();
        if(isset($quiz)){
            //Check Status
            //Check Time
        }
        else{
            // header("Location: ../pages/notFound.php");
        }
    }
    else{
        // header("Location: ../pages/notFound.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $quiz["quiz_name"]?> | TCC</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../tailwind/tailwind.css">
</head>
<body>
    <div class="w-full h-screen bg-tcc-darkBlue flex items-center justify-center">
        <div class="w-4/5 h-4/5 bg-tcc-darkGray flex flex-col items-center justify-center gap-3">
            <h1 class="text-6xl font-bold text-gray-100 pb-10"><?=$quiz["quiz_name"]?></h1>
            <div class="flex w-3/5 justify-center items-center gap-5 text-gray-100 my-10">
                <div class="flex flex-col justify-center items-center font-bold text-2xl ">
                    <span><?=date_format(new DateTime($quiz["time_start"],new DateTimeZone('Asia/Jakarta')), 'l, d F Y')?></span>
                    <span><?=date_format(new DateTime($quiz["time_start"],new DateTimeZone('Asia/Jakarta')), 'h:i A T (P)')?></span>
                </div>
                <span class="text-3xl">-</span>
                <div class="flex flex-col justify-center items-center font-bold text-2xl ">
                    <span><?=date_format(new DateTime($quiz["time_end"],new DateTimeZone('Asia/Jakarta')), 'l, d F Y')?></span>
                    <span><?=date_format(new DateTime($quiz["time_end"],new DateTimeZone('Asia/Jakarta')), 'h:i A T (P)')?></span>
                </div>
            </div>
            <button class="bg-blue-600 text-gray-200 font-bold px-5 py-2 text-xl rounded-lg">Take Quiz</button>
            <button class="bg-gray-200 text-blue-600 font-bold px-5 py-1 text-sm rounded-lg">Go Back</button>
        </div>
    </div>
</body>
</html>

