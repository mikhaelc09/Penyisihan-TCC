<?php
require_once("../util/connection.php");
if (isset($_SESSION['email']) && $_SESSION['email'] != "admin") {
    $email = $_SESSION['email'];
    $user = $conn->query("SELECT * From peserta where email = '$email'")->fetch_assoc();
} else {
    $user = "";
}

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
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
</head>

<body>
    <div class="w-full h-screen bg-tcc-darkBlue">
        <?php require("../components/adminnav.php") ?>
        <div class="bg-gray-200 h-3/4 font-sans w-full flex flex-row justify-center items-center">
            <div class="card w-96 mx-auto bg-white  shadow-xl hover:shadow">
                <img style="width:100px;height:100px" class="mx-auto rounded-full -mt-20" src="https://static.vecteezy.com/system/resources/previews/002/318/271/non_2x/user-profile-icon-free-vector.jpg" alt="">
                <div class="text-center mt-2 text-3xl font-medium"><?= $user['full_name'] ?></div>
                <div class="text-center mt-2 font-light text-sm"><?= $user['email'] ?></div>
                <div class="text-center font-normal text-lg"><?= $user['nrp'] ?></div>
                <div class="px-6 text-center mt-2 font-light text-sm">
                    <p class="my-2">
                        The Participant of Top Coder Competition (TCC) 2022
                    </p>
                </div>
                <!-- <hr class="mt-8">
                <a style="background-color:blue" href="" class="flex p-4">
                    <div class="w-full text-center text-white">
                        Edit Profile
                    </div>
                </a> -->
            </div>
        </div>
</body>

</html>