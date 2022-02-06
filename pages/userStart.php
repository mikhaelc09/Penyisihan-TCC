<?php
    require_once("../util/connection.php");
    require_once("../util/userValidation.php");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | TCC</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../tailwind/tailwind.css">
</head>
<body>
    <div class="w-full h-screen bg-tcc-darkBlue">
        <?php require("../components/navbar.php") ?>
        <main class="w-full flex flex-col items-center py-10 gap-4">
            <h1 class="text-lg text-gray-300 font-bold w-1/3 text-3xl">Welcome, <?= $user["full_name"] ?></h1>
            <div class="w-1/3 h-24 rounded-lg shadow-md bg-emerald-200 border-tcc-emerald border-4  flex flex-col px-5 py-4">
                <h1 class="text-xl font-bold">Guide:</h1>
                <p>To check your quiz, please check the announcement page</p>
            </div>

            <a href="./userAnnouncement.php" class="w-1/3">
                <section class="h-48 rounded-lg shadow-md bg-tcc-darkGray cursor-pointer flex items-center justify-center hover:bg-tcc-lightGray hover:underline underline-offset-4">
                    <h1 class="text-3xl font-bold">Announcement</h1>
                </section>
            </a>

            <a href="./userProfile.php" class="w-1/3">
                <section class="h-48 rounded-lg shadow-md bg-tcc-darkGray cursor-pointer flex items-center justify-center hover:bg-tcc-lightGray hover:underline underline-offset-4">
                    <h1 class="text-3xl font-bold">Profile</h1>
                </section>
            </a>

        </main>
    </div>
</body>
</html>