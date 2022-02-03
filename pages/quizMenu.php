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
</head>
<body>
<div class="w-full h-screen bg-tcc-darkBlue">
        <?php require("../components/adminnav.php")?>

        <main class="w-5/6 h-5/6 grid grid-cols-3 items-center py-10 gap-4 bg-tcc-lightGray px-4 mx-auto">
            <section class="col-span-2 h-full">
                <?php require("../components/quizBuilder.php")?>
            </section>
            <section class="h-full">
                <?php require("../components/quizNavigation.php")?>
            </section>
        </main>
        
    </div>
</body>
</html>