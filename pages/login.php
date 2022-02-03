<?php
    require("../util/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TCC</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../tailwind/tailwind.css">
</head>
<body>
    <div class="w-full h-screen bg-tcc-darkBlue">
        <?php require("../components/navbar.php")?>
        <div class="w-screen h-3/4 flex flex-col justify-center items-center">
            <form action="" class="flex flex-col items-center justify-between gap-5 bg-tcc-darkGray py-16 px-10 rounded-lg w-1/3 h-3/4">
                <h2 class="text-5xl font-bold">Login</h2>
                <div class="flex flex-col items-center justify-center w-full gap-y-5 h-4/5">
                    <input type="text" name="email" placeholder="Email" class="px-4 py-2 w-4/5 rounded-md">
                    <input type="password" name="password" placeholder="Password" class="px-4 py-2 w-4/5 rounded-md">
                    <input type="submit" value="Login" class="w-4/5 bg-tcc-darkEmerald rounded-md py-1 text-xl cursor-pointer hover:bg-tcc-emerald">
                </div>
            </form>
        </div>
    </div>
</body>
</html>