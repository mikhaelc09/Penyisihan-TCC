<?php
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Setup | TCC</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../tailwind/tailwind.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
</head>
<body>
<div class="w-full min-h-screen bg-tcc-darkBlue">
        <?php require("../components/adminnav.php")?>

        <main class="w-5/6 h-screen items-center py-10 gap-4 bg-tcc-lightGray px-4 mx-auto">
            <div class="flex flex-col" id="containerQuiz">
                <h1 class="text-4xl ml-10 mb-5 font-bold">Quiz List</h1>
                <div class='cursor-pointer w-4/5 h-24 bg-tcc-darkGray mx-auto my-3 px-4 py-2 flex flex-col-reverse items-center justify-evenly' id="newQuizButton">
                    <span class='text-xl font-bold text-blue-50'>Add New Quiz</span>
                    <span class="text-4xl text-blue-50">+</span>
                </div>
                
            </div >
        </main>
        
    </div>
</body>
</html>

<script>

    $("#btnCreateQuiz").click(() => {
        if($("#quizName").val().trim() !== "" &&
        $("#quizStartTime").val().trim() !== "" &&
        $("#quizEndTime").val().trim() !== "" ){
            $.ajax({
                type: "POST",
                url: "../ajax/quiz.php",
                data: {
                    "requestType" : "createQuiz",
                    "quizName" : $("#quizName").val(),
                    "quizStartTime" : $("#quizStartTime").val(),
                    "quizEndTime" : $("#quizEndTime").val()
                },
                success: function (response) {
                    resetForm()
                    console.log(response);
                }
            });
        }
    })

    $("#newQuizButton").click(() =>{
        $.confirm({
            title: 'Quiz Creation Form',
            content: '<div class="flex flex-col items-center justify-center w-4/5 mx-auto gap-y-3 my-5">'+
            '<label class="w-full text-xl">Quiz Name:</label>'+
            '<input type="text" id="quizName" class="w-full border-2 py-1 px-2">'+
            '<label class="w-full text-xl">Quiz Start Time:</label>'+
            '<input type="datetime-local" id="quizStartTime" class="w-full border-2 py-1 px-2">'+
            '<label class="w-full text-xl">Quiz End Time:</label>'+
            '<input type="datetime-local" id="quizEndTime" class="w-full border-2 py-1 px-2">'+
            '</div>',
            boxWidth: '40%',
            useBootstrap: false,
            draggable: true,
            escapeKey:'cancel',
            buttons:{
                cancel: {
                    btnClass: 'btn-red'    
                },
                create: {
                    action: () => {
                        if($("#quizName").val().trim() !== "" &&
                        $("#quizStartTime").val().trim() !== "" &&
                        $("#quizEndTime").val().trim() !== "" ){
                            $.ajax({
                                type: "POST",
                                url: "../ajax/quiz.php",
                                data: {
                                    "requestType" : "createQuiz",
                                    "quizName" : $("#quizName").val(),
                                    "quizStartTime" : $("#quizStartTime").val(),
                                    "quizEndTime" : $("#quizEndTime").val()
                                },
                                success: function (response) {
                                    resetForm()
                                    $.alert({
                                        boxWidth:'20%',
                                        useBootstrap:false,
                                        content:response,
                                        autoClose:'confirm|3000',
                                        buttons:{
                                            confirm:{}
                                        }
                                    });
                                    fetchQuiz();
                                }
                            });
                        }
                        else{
                            $.alert({
                                boxWidth:'20%',
                                useBootstrap:false,
                                content:'All field must be filled!',
                                autoClose:'confirm|5000',
                                buttons:{
                                    confirm:{}
                                }
                            });
                        }
                    },
                    btnClass: 'btn-blue'
                }
            }
        });
    })

    fetchQuiz();
    function fetchQuiz(){
        $.ajax({
            type: "POST",
            url: "../ajax/quiz.php",
            data: {
                "requestType" : "listQuiz"
            },
            success: function (response) {
                $("#containerQuiz").append(response);
            }
        });
    }
</script>