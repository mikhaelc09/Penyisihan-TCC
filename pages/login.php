<?php
require("../util/connection.php");
$peserta = $conn->query("SELECT * From peserta")->fetch_all(MYSQLI_ASSOC);
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($email == "admin" && $password == "adminTCC2022") {
        //pindah ke admin
        $_SESSION['email'] = $email;
        header('Location: adminStart.php');
    } else {
        $password = md5($password);
        $found = false;
        foreach ($peserta as $key => $value) {
            if ($email == $value['email'] && $password == $value['password']) {
                $found = true;
            }
        }
        if ($found) {
            //pindah ke user
            $_SESSION['email'] = $email;
            header('Location:userStart.php');
        } else {
            echo "<script>alert('Email or Password is incorrect')</script>";
        }
    }
}
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
        <?php require("../components/navbar.php") ?>
        <div class="w-screen h-3/4 flex flex-col justify-center items-center">
            <!-- <form action="" class="flex flex-col items-center justify-between gap-5 bg-white py-16 px-10 rounded-lg w-1/3 h-3/4" method="POST">
                <h2 class="text-5xl font-bold">Login</h2>
                <div class="flex flex-col items-center justify-center w-full gap-y-5 h-4/5">
                    <input style="border: 2px solid gray" type="text" name="email" placeholder="Email" class="px-4 py-2 w-4/5 rounded-md">
                    <input style="border: 2px solid gray" type="password" name="password" placeholder="Password" class="px-4 py-2 w-4/5 rounded-md">
                    <input type="submit" name="login" value="Login" class="w-4/5 bg-tcc-darkEmerald rounded-md py-1 text-xl cursor-pointer hover:bg-tcc-emerald">
                </div>
            </form> -->
            <div class="card bg-white shadow-md rounded-lg px-4 py-4 mb-6 ">
                <form action="" method="POST">
                    <div class="flex items-center justify-center">
                        <h2 class="text-2xl font-bold tracking-wide">
                            Welcome back
                        </h2>
                    </div>
                    <h2 class="text-xl text-center font-semibold text-gray-800 mb-2">
                        Sign In
                    </h2>
                    <input type="text" name="email" class="rounded px-4 w-full py-1 bg-gray-200  border border-gray-400 mb-6 text-gray-700 placeholder-gray-700 focus:bg-white focus:outline-none" placeholder="Email Address">
                    <input type="password" name="password" class="rounded px-4 w-full py-1 bg-gray-200  border border-gray-400 mb-4 text-gray-700 placeholder-gray-700 focus:bg-white focus:outline-none" placeholder="Password">
                    <div class="flex items-center justify-between">
                        <button name="login" value="1" class="w-full bg-blue-900 text-gray-200  px-2 py-1 rounded hover:bg-blue-600">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>