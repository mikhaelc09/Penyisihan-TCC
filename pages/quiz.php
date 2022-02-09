<?php
    require_once("../util/connection.php");
    require_once("../util/userValidation.php");

    if(isset($_GET["id"])){
        $quiz_id = $_GET["id"];
        $stmt = $conn->query("SELECT quiz.quiz_id, quiz.quiz_name, sq.jumlah, sq.totaldurasi FROM quiz, (SELECT COUNT(*) AS jumlah , SUM(durasi) AS totaldurasi FROM soal WHERE quiz_id=$quiz_id) sq WHERE quiz_id=$quiz_id");
        $quiz = $stmt->fetch_assoc();
        // echo "<pre>";
        // print_r($quiz);
        // echo "</pre>";
        if(!isset($quiz)){
            header("Location: ../pages/notFound.php");
        }
        else{
            $stmt = $conn->query("SELECT q.score FROM quiz_summary q, peserta p WHERE q.user_id=p.user_id AND p.email='$emailUser'");
            $quiz_summary = $stmt->fetch_assoc();
            if(!$quiz_summary){
                if(isset($_COOKIE["sequence"])){
                    $seq = json_decode($_COOKIE["sequence"]);
                    $probCtr = $_COOKIE["counter"];
                    $startTime = json_decode($_COOKIE["startTime"]);
                    $endTime = $_COOKIE["endTime"];
    
                    // echo "<pre>";
                    // print_r($seq);
                    // echo "</pre>";
                    // echo $probCtr;
                    // echo "<pre>";
                    // print_r($startTime);
                    // echo "</pre>";
                    // echo $endTime;
    
                    // setcookie("quizid","", time() - 10000, '/');
                    // setcookie("sequence","", time()  - 10000, '/');
                    // setcookie("counter", "", time() - 10000, '/');
                    // setcookie("startTime", "" , time() - 10000, '/');
                    // setcookie("endTime", "" , time() - 10000, '/');
                }
                else{
                    
                    $stmt = $conn->prepare("SELECT soal_id FROM soal WHERE quiz_id=$quiz_id");
                    $stmt->execute();
                    $seq= $stmt->get_result()->fetch_all(MYSQLI_NUM);
                    // foreach(range(0, $quiz["jumlah"]-1) as $num) $seq[] = $num;
                    foreach ($seq as $key => $value) {
                        $seq[$key] = $value[0];
                    }
                    shuffle($seq);
                    // echo "<pre>";
                    // print_r($seq);
                    // echo "</pre>";
                    $probCtr = 0;
                    $startTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                    $endTime = time() + $quiz["totaldurasi"];
                    setcookie("quizid", $quiz_id, $endTime, '/');
                    setcookie("sequence",json_encode($seq), $endTime, '/');
                    setcookie("counter", $probCtr, $endTime, '/');
                    setcookie("startTime", json_encode($startTime) , $endTime, '/');
                    setcookie("endTime", $endTime , $endTime, '/');
                }
            }
            else{
                $_SESSION["quizid"] = $_GET["id"];
            }
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
    <title><?=$quiz["quiz_name"]?> | TCC</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../tailwind/tailwind.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    
    <div class="w-full h-screen bg-tcc-darkBlue flex flex-col items-center justify-center gap-y-2">
            <div class="w-4/5 h-5 bg-tcc-darkGray rounded-lg">
                <div class="w-4/5 h-5 absolute text-center font-bold text-white" id="timer"></div>
                <div class="bg-tcc-darkEmerald h-full rounded-lg transition-all duration-100 font-bold" style="width: 100%;" id="loading-bar"></div>
            </div>
            <div class="w-4/5 h-4/5 bg-indigo-500 rounded-lg drop-shadow-2xl flex flex-col items-center justify-evenly gap-y-2 py-2" id="container">
                <div class="w-full h-4/6 ">
                    <h1 class="pl-10 pt-3 text-xl font-bold" id="no-soal"></h1>
                    <div class="w-full h-full flex flex-col items-center justify-evenly">
                        <img src="" class="h-3/4 w-fit " id="question-image" onclick="enlargeImage()">
                        <h1 class="px-10 text-lg" id="question-field"></h1>
                    </div>
                </div>
                <div class="w-full h-2/6 flex px-2 items-center justify-evenly">
                    <button class="w-1/6 h-5/6 transition-colors delay-100 bg-gray-300 hover:brightness-110 rounded-xl" id="choice1" onclick="chooseAnswer(1)"></button>
                    <button class="w-1/6 h-5/6 transition-colors delay-100 bg-gray-300 hover:brightness-110 rounded-xl" id="choice2" onclick="chooseAnswer(2)"></button>
                    <button class="w-1/6 h-5/6 transition-colors delay-100 bg-gray-300 hover:brightness-110 rounded-xl" id="choice3" onclick="chooseAnswer(3)"></button>
                    <button class="w-1/6 h-5/6 transition-colors delay-100 bg-gray-300 hover:brightness-110 rounded-xl" id="choice4" onclick="chooseAnswer(4)"></button>
                    <button class="w-1/6 h-5/6 transition-colors delay-100 bg-gray-300 hover:brightness-110 rounded-xl" id="choice5" onclick="chooseAnswer(5)"></button>
                </div>
            </div>
            <div class="absolute w-screen h-screen bg-black bg-opacity-60 flex items-center justify-center" id="bigger-container" onclick="hideBigPicture()">
                <img src="https://lh3.googleusercontent.com/_kMkmvYTzJ9FH8ugsZ-JkOtctzquns4_tPORouY-U6rdA1Bn6Xc7DisM2-EtGoMQ7uwgy6FbR-3PbQE=w544-h544-l90-rj" class="h-5/6 w-fit" id="bigger-image">
            </div>
    </div>

    <script src="../util/quizSystem.js"></script>
    <?php
        if($quiz_summary){
    ?>
        <script>
            finish();
            clearInterval(render)
        </script>
    <?php
        }
    ?>
</body>
</html>