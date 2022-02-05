<?php
require_once("../util/connection.php");
$email = $_SESSION['email'];
$user = $conn->query("SELECT * From peserta where email = '$email'")->fetch_assoc();
if (isset($_POST['save'])) {
    $old = md5($_POST['old']);
    $new = md5($_POST['new']);
    $confirm = md5($_POST['confirm']);
    $user_id = $user['user_id'];
    if ($new != $confirm) {
        echo "<script>alert('Password and confirm password is different')</script>";
    } else if ($user['password'] != $old) {
        echo "<script>alert('Your password is different with this account's password');</script>";
    } else {
        $stmt = $conn->prepare("UPDATE `peserta` SET `password` = ? WHERE `peserta`.`user_id` = ?");
        $stmt->bind_param("ss", $new, $user_id);
        $stmt->execute();
        echo "<script>alert('Password has already changed')</script>";
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
        <div class="flex items-center justify-center bg-transparent">
            <div class="bg-white p-16 rounded shadow-2xl sm:w-full lg:w-1/3">
                <h2 class="text-3xl font-bold mb-10 text-gray-800">Change Password</h2>
                <form class="" method="POST">
                    <div>
                        <label class="block mb-1 font-bold text-black">Old Password</label>
                        <input type="password" name="old" class="w-full border-2 border-black p-1 mb-2 rounded outline-none focus:border-gray-500">
                    </div>
                    <div>
                        <label class="block mb-1 font-bold text-black">New Password</label>
                        <input type="password" name="new" class="w-full border-2 border-black p-1 mb-2 rounded outline-none focus:border-gray-500">
                    </div>
                    <div>
                        <label class="block mb-1 font-bold text-black">Confirm Password</label>
                        <input type="password" name="confirm" class="w-full border-2 border-black p-1 mb-5 rounded outline-none focus:border-gray-500">
                    </div>
                    <button name="save" value="1" class="border-2 border-black text-black block w-full bg-tcc-orange hover:bg-orange-200 p-4 rounded hover:text-yellow-800 transition duration-300">Save</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>