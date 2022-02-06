<?php
    require_once("../util/connection.php");
    require_once("../util/adminValidation.php");
    if(isset($_GET["quiz_id"])){
        $quiz_id = $_GET["quiz_id"];
        $stmt = $conn->query("SELECT * FROM quiz WHERE quiz_id=$quiz_id");
        $quiz = $stmt->fetch_assoc();
    }
    else{
        header("Location:./quizMenu.php");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
</head>
<body>
    <div class="w-full min-h-screen bg-tcc-darkBlue">
        <?php require("../components/adminnav.php")?>

        <div class=" w-4/5 mx-auto min-h-screen bg-tcc-lightGray rounded-xl flex justify-center items-center">
            <div class="w-5/6 min-h-screen  py-10">
                <h1 class="text-5xl pb-5 font-bold"><?=$quiz["quiz_name"]?></h1>
                <h2 class="text-xl py-1">Time Start : <?= $quiz["time_start"] ?></h2>
                <h2 class="text-xl py-1">Time End   : <?= $quiz["time_end"] ?></h2>
                <h2 class="text-xl py-1">Status : 
                    <?php
                        if(!$quiz["status"]) echo "<button class='text-sm font-bold cursor-pointer bg-red-500 px-5' id='statusToggle'>Nonactive</button></h2>";
                        else echo "<button class='text-sm font-bold cursor-pointer bg-green-500 px-5' id='statusToggle'>Active</button></h2>";
                    ?>
                <h2 class="text-xl py-1">Problems : </h2>
                <div class="w-full flex flex-col">
                    <div class="flex gap-x-2 justify-end py-2 px-2">
                        <div class="px-5 bg-tcc-emerald w-fit border-4 border-tcc-darkEmerald rounded-lg font-bold cursor-pointer" onclick="createProblem()">+ Add new question</div>
                        <div class="px-5 bg-white w-fit  border-4 border-tcc-darkEmerald rounded-lg font-bold cursor-pointer text-tcc-darkEmerald" onclick="uploadProblemsExcel()">+ Add using CSV</div>
                    </div>
                    <div id="probsContainer">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function createProblem(){
        // $.confirm({
        //     title: 'Problem Creation Form',
        //     content: "<div class='gap-y-2 grid grid-cols-12 px-4'>"+
        //             "    <label class='col-span-2' >Question :</label>"+
        //             "    <textarea id='question' cols='30' rows='3' class='col-start-3 col-end-13 border-2'></textarea>"+
        //             "    <label class='col-span-2'>Choice A :</label>"+
        //             "    <input type='text' id='choiceA' class='col-start-3 col-end-11 border-2'>"+
        //             "    <div class='col-span-2 flex items-center mx-auto'><input type='radio' id='correctA' name='correct' value='1' class='mr-2 w-5 h-5'><label for='correctA'>Correct Answer</label></div>"+
        //             "    <label class='col-span-2'>Choice B :</label>"+
        //             "    <input type='text' id='choiceB' class='col-start-3 col-end-11 border-2'>"+
        //             "    <div class='col-span-2 flex items-center mx-auto'><input type='radio' id='correctB' name='correct' value='2' class='mr-2 w-5 h-5'><label for='correctB'>Correct Answer</label></div>"+
        //             "    <label class='col-span-2'>Choice C :</label>"+
        //             "    <input type='text' id='choiceC' class='col-start-3 col-end-11 border-2'>"+
        //             "    <div class='col-span-2 flex items-center mx-auto'><input type='radio' id='correctC' name='correct' value='3' class='mr-2 w-5 h-5'><label for='correctC'>Correct Answer</label></div>"+
        //             "    <label class='col-span-2'>Choice D :</label>"+
        //             "    <input type='text' id='choiceD' class='col-start-3 col-end-11 border-2'>"+
        //             "    <div class='col-span-2 flex items-center mx-auto'><input type='radio' id='correctD' name='correct' value='4' class='mr-2 w-5 h-5'><label for='correctD'>Correct Answer</label></div>"+
        //             "    <label class='col-span-2'>Choice E :</label>"+
        //             "    <input type='text' id='choiceE' class='col-start-3 col-end-11 border-2'>"+
        //             "    <div class='col-span-2 flex items-center mx-auto'><input type='radio' id='correctE' name='correct' value='5' class='mr-2 w-5 h-5'><label for='correctE'>Correct Answer</label></div>"+
        //             "    <label class='col-span-2'>Duration : </label>"+
        //             "    <input type='number' id='duration' class='col-span-2 border-2'>"+
        //             "    <span class='ml-2 col-start-5 col-end-13'>Seconds</span>"+
        //             "    <label class='col-span-2'>Image for Question : </label>"+
        //             "    <input type='file' id='problemImage' class='col-start-3 col-end-13'>"+
        //             "</div>",
        //     boxWidth:'40%',
        //     useBootstrap: false,
        //     escapeKey: 'cancel',
        //     buttons: {
        //         cancel: {
        //             btnClass: 'btn-red'
        //         },
        //         confirm: {
        //             btnClass: 'btn-blue',
        //             action: ()=>{
        //                 $.ajax({
        //                     type: "POST",
        //                     url: "../ajax/problems.php",
        //                     data: {
        //                         "requestType": "addProblem",
        //                         "quiz_id": $quiz_id,

        //                     },
        //                     dataType: "dataType",
        //                     success: function (response) {
                                
        //                     }
        //                 });
        //             }
        //         }
        //     }
        // })

        $.alert({
            title: 'Problem Creation Form',
            content: 'Coming soon',
            boxWidth: '30%',
            useBootstrap: false,
            autoClose: 'ok|3000',
            buttons:{
                ok:{}
            }
        })
    }

    function uploadProblemsExcel(){
        $.confirm({
            title: "Problem Excel Upload",
            content: `<form method="POST" enctype="multipart/form-data">
                            <input type="file" id="excel">
                            <input type="hidden" id="quiz_id" value="<?= $quiz_id?>">
                        </form>`,
            boxWidth: '30%',
            useBootstrap: false,
            buttons:{
                cancel: {},
                upload: {
                    btnClass: 'btn-blue',
                    action: () =>{
                        let uploaded = $("#excel")[0];
                        let qid = $("#quiz_id").val();
                        var fd = new FormData();
                        for(let i = 0 ; i < uploaded.files.length; i++){
                            fd.append('file', uploaded.files[i]);
                        }
                        fd.append('quiz_id',qid);
                        fd.append('requestType','uploadExcel')
                        $.ajax({
                            method: "POST",
                            url: "../ajax/problems.php",
                            data: fd,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                $.alert({
                                    content: response,
                                    escapeKey: 'ok',
                                    boxWidth: '30%',
                                    useBootstrap: false,
                                    buttons: {
                                        ok:{}
                                    }
                                });
                            }
                        });
                    }
                }
            }
        })
    }

    let quizStatus = 0;
    if($("#statusToggle").hasClass("bg-green-500")){
        quizStatus = 1;
    }

    $("#statusToggle").click(() =>{
        $("#statusToggle").toggleClass("bg-green-500");
        $("#statusToggle").toggleClass("bg-red-500");
        if($("#statusToggle").hasClass("bg-red-500")) $("#statusToggle").text("Nonactive")
            else  $("#statusToggle").text("Active")
        quizStatus = (quizStatus+1)%2;
        $.ajax({
            type: "POST",
            url: "../ajax/quiz.php",
            data: {
                "requestType" : "toggleStatus",
                "status" : quizStatus,
                "quiz_id" : '<?= $quiz_id ?>'
            },
            success: function (response) {
                console.log(response);
            }
        });
    })

    fetchProblem();
    function fetchProblem(){
        $.ajax({
            type: "POST",
            url: "../ajax/problems.php",
            data: {
                "requestType": "fetchProblem",
                "quiz_id" : <?= $quiz_id?>
            },
            success: function (response) {
                $("#probsContainer").html(response);
            }
        });
    }
</script>
</body>
</html>

