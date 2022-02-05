<?php
require_once("../util/connection.php");
$peserta = $conn->query("SELECT * From peserta")->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['register'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $nrp = $_POST['nrp'];
    $line_id = $_POST['line_id'];
    if ($password == $confirm) {
        $password = md5($confirm);
        $status = 1;
        $score = 0;
        $found = false;
        foreach ($peserta as $key => $value) {
            if ($value['email'] == $email) {
                $found =  true;
            } else if ($value['nrp'] == $nrp) {
                $found = true;
            }
        }
        if ($email == "admin") {
            //register ke admin
            $found = true;
        }
        if ($found) {
            echo "<script>alert('Email is already used')</script>";
        } else {
            $stmt = $conn->prepare("INSERT INTO `peserta` (`full_name`, `email`, `password`, `nrp`, `line_id`, `status`, `score`) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssii", $full_name, $email, $password, $nrp, $line_id, $status, $score);
            $stmt->execute();
            echo "<script>alert('You have a new account')</script>";
            header('Location:login.php');
        }
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

        <div class="flex h-2/3 bg-transparent">
            <div class="m-auto">
                <div>
                    <form class="mt-5 bg-white rounded-lg shadow" method="POST" action="">
                        <div class="flex">
                            <div class="flex-1 py-5 pl-5 overflow-hidden">
                                <h1 class="pl-2 inline text-2xl font-semibold leading-none">Register</h1>
                            </div>
                        </div>
                        <div class="px-5 pb-5">
                            <input type="text" placeholder="Full Name" name="full_name" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            <input type="text" placeholder="Email" name="email" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            <input type="text" placeholder="NRP" name="nrp" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">

                        </div>

                        <div class="px-5 pb-5">
                            <input type="password" placeholder="Password" name="password" class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            <input type="password" placeholder="Confirm Password" name="confirm" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            <input type="text" placeholder="Line ID" name="line_id" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                        </div>
                        <hr class="mt-4">
                        <div class="flex flex-row-reverse p-3">
                            <div class="flex-initial pl-3">
                                <button type="submit" name="register" value="1" class="flex items-center px-5 py-2.5 font-medium tracking-wide text-white capitalize   bg-black rounded-md hover:bg-gray-800  focus:outline-none focus:bg-gray-900  transition duration-300 transform active:scale-95 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                        <path d="M5 5v14h14V7.83L16.17 5H5zm7 13c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-8H6V6h9v4z" opacity=".3"></path>
                                        <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm2 16H5V5h11.17L19 7.83V19zm-7-7c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3zM6 6h9v4H6z"></path>
                                    </svg>
                                    <span class="pl-2 mx-1">Save</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>