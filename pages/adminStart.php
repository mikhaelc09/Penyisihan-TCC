<?php
require_once("../util/connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home | TCC</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../tailwind/tailwind.css">
</head>

<body>
    <div class="w-full h-screen bg-tcc-darkBlue">
        <?php require("../components/adminnav.php") ?>

        <main class="w-full flex flex-col items-center py-10 gap-4">

            <a href="" class="w-1/3">
                <section class="h-48 rounded-lg shadow-md bg-tcc-darkGray cursor-pointer flex items-center justify-center hover:bg-tcc-lightGray hover:underline underline-offset-4">
                    <h1 class="text-3xl font-bold">Announcement</h1>
                </section>
            </a>

            <a href="../pages/quizSetup.php" class="w-1/3">
                <section class="h-48 rounded-lg shadow-md bg-tcc-darkGray cursor-pointer flex items-center justify-center hover:bg-tcc-lightGray hover:underline underline-offset-4">
                    <h1 class="text-3xl font-bold">Quiz</h1>
                </section>
            </a>

            <a href="../pages/adminListUser.php" class="w-1/3">
                <section class="h-48 rounded-lg shadow-md bg-tcc-darkGray cursor-pointer flex items-center justify-center hover:bg-tcc-lightGray hover:underline underline-offset-4">
                    <h1 class="text-3xl font-bold">Users</h1>
                </section>
            </a>

        </main>
    </div>
</body>

</html>