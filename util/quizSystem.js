clearInterval();
let perc = 0;
let duration = 0;
let counter = 0;
let activeQuestion;
let isPaused = false;
let justEntered = true;
function timeRefresh(){
    render = setInterval(()=>{
        if(!isPaused){
            perc-= 100/duration;
            $("#loading-bar").css("width", `${perc}%`);
            counter++;
            $("#timer").text(`${duration-counter}s`)
            if(perc <= 0){
                isPaused = true;
                getNewQuestion();
            }
        }
    }, 1000);
}

function getNewQuestion(){
    $("#container").slideUp();
    setTimeout(() => {
        isPaused = false;
        $.ajax({
            type: "POST",
            url: "../ajax/quiz.php",
            data: {
                "requestType" : "getQuestion",
                "justEntered":justEntered
            },
            xhrFields: {
                withCredentials: true
            },
            success: function (response) {
                if(justEntered){
                    justEntered = false;
                }
                if(response=="Finish"){
                    clearInterval(render);
                    finish();
                }
                else{
                    activeQuestion = JSON.parse(response);
                    $("question-field").text(activeQuestion.pertanyaan)
                    perc = 100;
                    counter = 0;
                    duration = parseInt(activeQuestion.durasi);
                    $("#no-soal").html(`Soal ${parseInt(activeQuestion.counter)+1}`);
                    $("#question-field").html("");
                    $("#question-field").html(activeQuestion.pertanyaan);
                    $("#loading-bar").css("width", `${perc}%`);
                    $("#timer").text(`${duration-counter}s`)
                    if(activeQuestion.gambar_soal.length > 0){
                        $("#question-image").show();
                        $("#question-image").attr("src",activeQuestion.gambar_soal);
                        $("#bigger-image").attr("src",activeQuestion.gambar_soal);
                    }
                    else{
                        $("#question-image").hide();
                    }
                    getAnswer(activeQuestion.pilihan_a, "#choice1")
                    getAnswer(activeQuestion.pilihan_b, "#choice2")
                    getAnswer(activeQuestion.pilihan_c, "#choice3")
                    getAnswer(activeQuestion.pilihan_d, "#choice4")
                    getAnswer(activeQuestion.pilihan_e, "#choice5")
                }
            }
        });
        $("#container").slideDown();
    }, 2000);
}

function getAnswer(source, objId){
    if(source.substring(0,4) == "http"){
        $(objId).html(`<img src='${source}' class='h-fit w-fit'>`)
    }
    else if(source == ""){
        let alpha = ["A", "B", "C", "D", "E"]
        $(objId).html(`${alpha[parseInt(objId.substring(objId.length-1, objId.length))-1]}`)
    }
    else{
        $(objId).html(`${source}`)
    }
}

function chooseAnswer(num){
    $.ajax({
        type: "POST",
        url: "../ajax/quiz.php",
        data: {
            "requestType" : "checkAnswer",
            "choice" : num,
            "soal_id" : activeQuestion.soal_id
        },
        success: function (response) {
            isPaused = true;
            if(response == 1){
                $(`#choice${num}`).removeClass("bg-gray-300")
                $(`#choice${num}`).addClass("bg-green-600")
            }
            else{
                $(`#choice${num}`).removeClass("bg-gray-300")
                $(`#choice${num}`).addClass("bg-red-600")
            }
            setTimeout(() => {
                $(`#choice${num}`).removeClass("bg-red-600")
                $(`#choice${num}`).removeClass("bg-green-600")
                $(`#choice${num}`).addClass("bg-gray-300")
                getNewQuestion();
            }, 1000);
        }
    });
}

function finish(){
    $.ajax({
        type: "POST",
        url: "../ajax/quiz.php",
        data: {
            "requestType":"getFinalScore"
        },
        success: function (response) {
            $("#container").slideDown();
            $("#container").html(`<h1 class='text-6xl font-bold'>Quiz Finished</h1><h1 class='text-2xl'>Your Score is ${response} </h1><a href='../pages/start.php'><button class='px-4 py-1 bg-tcc-darkEmerald text-gray-200 font-bold rounded drop-shadow-lg'>Go Back</button></a>`);
            $("#timer").hide();
        }
    });
}

function enlargeImage(){
    $("#bigger-container").show(00);
}

function hideBigPicture(){
    $("#bigger-container").hide();
}

hideBigPicture();

timeRefresh()
$("#question-image").hide();