<?php
require_once("../util/connection.php");

if (isset($_POST['register'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $nrp = $_POST['nrp'];
    if ($password == $confirm) {
        $password = md5($confirm);
        $status = 1;
        $score = 0;
        $stmt = $conn->prepare("INSERT INTO `peserta` (`full_name`, `email`, `password`, `nrp`, `status`, `score`) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssii", $full_name, $email, $password, $nrp, $status, $score);
        $stmt->execute();
        echo "<script>alert('You have successfully register')</script>";
    } else {
        echo "<script>alert('Password and confirm password is different')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | TCC</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../tailwind/tailwind.css">
</head>

<body>
    <div class="w-full h-screen bg-tcc-darkBlue">
        <?php require("../components/navbar.php") ?>
        <div class="w-screen h-3/4 flex flex-col justify-center items-center">
            <form action="" class="flex flex-col items-center justify-between gap-5 bg-tcc-darkGray py-16 px-10 rounded-lg w-1/3 h-4/4" method="POST">
                <h2 class="text-5xl font-bold">Register</h2>
                <div class="flex flex-col items-center justify-center w-full gap-y-5 h-4/5 py-2">
                    <div class="flex flex-row w-4/5 items-center">
                        <label for="full_name" class="w-2/5 px-5">Full Name</label>
                        <input type="text" name="full_name" placeholder="Full Name" class="px-5 py-2 rounded-md w-4/5">
                    </div>
                    <div class="flex flex-row w-4/5 items-center">
                        <label for="email" class="w-2/5 px-5">Email</label>
                        <input type="text" name="email" placeholder="Email" class="px-5 py-2 rounded-md w-4/5">
                    </div>
                    <div class="flex flex-row w-4/5 items-center">
                        <label for="password" class="px-5">Password</label>
                        <input type="text" name="password" placeholder="Password" class="px-4 py-2 rounded-md w-4/5">
                    </div>
                    <div class="flex flex-row w-4/5 items-center">
                        <label for="confirm" class="px-5">Confirm Password</label>
                        <input type="text" name="confirm" placeholder="Confirm Password" class="px-4 py-2 rounded-md w-4/5">
                    </div>
                    <div class="flex flex-row w-4/5 items-center">
                        <label for="nrp" class="px-5">NRP</label>
                        <input type="text" name="nrp" placeholder="NRP" class="px-4 py-2 rounded-md w-4/5">
                    </div>
                    <input type="submit" value="Register" name="register" class="w-4/5 bg-tcc-darkEmerald rounded-md py-1 text-xl cursor-pointer hover:bg-tcc-emerald">
                </div>
            </form>
        </div>
    </div>
</body>

</html>